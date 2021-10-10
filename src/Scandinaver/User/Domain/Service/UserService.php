<?php


namespace Scandinaver\User\Domain\Service;

use Carbon\Carbon;
use Doctrine\Common\Collections\ArrayCollection;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\Facades\Auth;
use Scandinaver\Common\Domain\Contract\Repository\LanguageRepositoryInterface;
use Scandinaver\Common\Domain\Contract\UserInterface;
use Scandinaver\Common\Domain\Entity\Language;
use Scandinaver\Common\Domain\Service\IntroService;
use Scandinaver\Common\Domain\Service\LanguageService;
use Scandinaver\Common\Domain\Service\LanguageTrait;
use Scandinaver\Learn\Domain\Contract\Repository\AssetRepositoryInterface;
use Scandinaver\Learn\Domain\Contract\Repository\FavouriteAssetRepositoryInterface;
use Scandinaver\Learn\Domain\Contract\Repository\PersonalAssetRepositoryInterface;
use Scandinaver\Learn\Domain\Exception\LanguageNotFoundException;
use Scandinaver\Learn\Domain\Entity\{Asset, FavouriteAsset, PersonalAsset};
use Scandinaver\Learn\Domain\Service\AssetService;
use Scandinaver\Puzzle\Domain\Service\PuzzleService;
use Scandinaver\RBAC\Domain\Contract\Repository\RoleRepositoryInterface;
use Scandinaver\Shared\Contract\BaseServiceInterface;
use Scandinaver\Translate\Domain\Contract\Repository\TextRepositoryInterface;
use Scandinaver\Translate\Domain\Service\TextService;
use Scandinaver\User\Domain\Contract\Repository\UserRepositoryInterface;
use Scandinaver\User\Domain\Contract\Service\AvatarServiceInterface;
use Scandinaver\User\Domain\DTO\State;
use Scandinaver\User\Domain\DTO\UserDTO;
use Scandinaver\User\Domain\Exception\UserNotFoundException;
use Scandinaver\User\Domain\Entity\{User};

/**
 * Class UserService
 * todo: refactor
 *
 * @package Scandinaver\User\Domain\Services
 */
class UserService implements BaseServiceInterface
{

    use LanguageTrait;

    protected AssetService $assetService;

    protected UserRepositoryInterface $userRepository;

    protected LanguageRepositoryInterface $languageRepository;

    protected AssetRepositoryInterface $assetRepository;

    protected FavouriteAssetRepositoryInterface $favouriteAssetRepository;

    protected PersonalAssetRepositoryInterface $personalAssetRepository;

    protected TextRepositoryInterface $textRepository;

    private TextService $textService;

    private PuzzleService $puzzleService;

    private IntroService $introService;

    private LanguageService $languageService;

    private RoleRepositoryInterface $roleRepository;

    private AvatarServiceInterface $avatarService;

    private UserFactory $userFactory;

    public function __construct(AssetRepositoryInterface $assetRepository,
                                FavouriteAssetRepositoryInterface $favouriteAssetRepository,
                                PersonalAssetRepositoryInterface $personalAssetRepository,
                                AssetService $assetService,
                                UserRepositoryInterface $userRepository,
                                LanguageRepositoryInterface $languageRepository,
                                TextRepositoryInterface $textRepository,
                                RoleRepositoryInterface $roleRepository,
                                TextService $textService,
                                PuzzleService $puzzleService,
                                LanguageService $languageService,
                                AvatarServiceInterface $avatarService,
                                IntroService $introService,
                                UserFactory $userFactory)
    {
        $this->userRepository           = $userRepository;
        $this->languageRepository       = $languageRepository;
        $this->assetRepository          = $assetRepository;
        $this->textRepository           = $textRepository;
        $this->assetService             = $assetService;
        $this->textService              = $textService;
        $this->puzzleService            = $puzzleService;
        $this->favouriteAssetRepository = $favouriteAssetRepository;
        $this->personalAssetRepository  = $personalAssetRepository;
        $this->introService             = $introService;
        $this->languageService          = $languageService;
        $this->avatarService            = $avatarService;
        $this->roleRepository           = $roleRepository;
        $this->userFactory              = $userFactory;
    }

    /**
     * @param  int  $id
     *
     * @return User
     * @throws UserNotFoundException
     */
    public function one(int $id): User
    {
        return $this->getUser($id);
    }

    /**
     * @param  int  $id
     *
     * @return User
     * @throws UserNotFoundException
     */
    private function getUser(int $id): UserInterface
    {
        $user = $this->userRepository->find($id);
        if ($user === NULL) {
            throw new UserNotFoundException();
        }

        return $user;
    }

    public function all(): array
    {
        return $this->userRepository->findAll();
    }

    /**
     * @param  array  $credentials
     *
     * @return User|null
     * @throws UserNotFoundException
     */
    public function login(array $credentials): ?UserInterface
    {
        if (!Auth::attempt($credentials, TRUE)) {
            throw new UserNotFoundException();
        }

        return \App\Helpers\Auth::user();
    }

    /**
     * @param  UserDTO  $userDTO
     *
     * @return User
     * @throws Exception
     */
    public function registration(UserDTO $userDTO): User
    {

        $languages = $this->languageRepository->findAll();

        $user = $this->userFactory->fromDTO($userDTO);

        $user->setActive(TRUE);

        foreach ($languages as $language) {
            $favourite = new FavouriteAsset($language);
            $favourite->setOwner($user);
            $user->addPersonalAsset($favourite);
        }

        $this->userRepository->save($user);

        $isLoggedIn = Auth::check();
        if ($isLoggedIn === FALSE) {
            Auth::loginUsingId($user->getId(), TRUE);
        }

        return $user;
    }

    /**
     * @param  User    $user
     * @param  string  $language
     *
     * @return State
     * @throws LanguageNotFoundException|BindingResolutionException
     */
    public function getState(User $user, string $language): State
    {
        $language = $this->getLanguage($language);

        /** @var PersonalAsset[] $personalAssets TODO: move to AssetService::getAssetsByType() */
        $personalAssets = $user->getPersonalAssets($language);
        foreach ($personalAssets as $personalAsset) {

            if ($user->isRaising()) {
                $personalAsset->setActive(TRUE);
                $personalAsset->setAvailable(TRUE);
            }

            $result = $personalAsset->getBestResultForUser($user);
            $personalAsset->setBestResult($result);
        }

        $favouriteAsset = $user->getFavouriteAsset($language);
        $result         = $favouriteAsset->getBestResultForUser($user);
        $favouriteAsset->setActive(TRUE);
        $favouriteAsset->setAvailable(TRUE);
        $favouriteAsset->setBestResult($result);

        $stateDTO = new State();

        $stateDTO->setSite(config('app.MAIN_SITE'));

        $wordAssets = $this->assetService->getAssetsByType($language->getLetter(), $user, Asset::TYPE_WORDS);
        $stateDTO->setWordsAssets($wordAssets);

        $sentencesAssets = $this->assetService->getAssetsByType($language->getLetter(), $user, Asset::TYPE_SENTENCES);
        $stateDTO->setSentencesAssets($sentencesAssets);

        $stateDTO->setPersonalAssets($personalAssets);
        $stateDTO->setFavouriteAsset($favouriteAsset);

        $texts = $this->textService->getTextsForUser($language->getLetter(), $user);
        $stateDTO->setTexts($texts);

        $puzzles = $this->puzzleService->getForUser($language->getLetter(), $user);
        $stateDTO->setPuzzles($puzzles);

        $intros = $this->introService->active();
        $stateDTO->setIntro($intros);

        $languages = $this->languageService->all($user);
        $stateDTO->setLanguages($languages);

        $stateDTO->setCurrentLanguage($language);

        return $stateDTO;
    }

    public function getInfo(UserInterface $user): UserInterface
    {
        return \App\Helpers\Auth::user();
    }

    public function updateUserInfo(User $user, array $data): void
    {
        $data['password'] = isset($data['password']) ? bcrypt($data['password']) : $user->getPassword();

        $this->userRepository->update($user, $data);
    }

    /**
     * @param  int    $id
     * @param  array  $data
     *
     * @return User
     * @throws UserNotFoundException
     */
    public function updateUser(int $id, array $data): User
    {
        $user = $this->getUser($id);

        $roles = $data['roles'];

        $roleCollection = new ArrayCollection();

        foreach ($roles as $roleData) {
            $role = $this->roleRepository->find($roleData['id']);
            $roleCollection->add($role);
        }

        $user->setRoles($roleCollection);

        if (array_key_exists('password', $data)) {
            $data['password'] = bcrypt($data['password']);
        }

        if (array_key_exists('plan', $data)) { //TODO: make plans
           // $data['plan'] = $this->planRepository->find($data['plan']['_id']);
        }

        return $this->userRepository->update($user, $data);
    }

    /**
     * @param  int  $id
     *
     * @throws UserNotFoundException
     */
    public function delete(int $id): void
    {
        $user = $this->userRepository->find($id);
        if ($user === NULL) {
            throw new UserNotFoundException();
        }

        $this->userRepository->delete($user);
    }

}