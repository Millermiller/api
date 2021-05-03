<?php


namespace Scandinaver\User\Domain\Service;

use Auth;
use Carbon\Carbon;
use Doctrine\Common\Collections\ArrayCollection;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;
use Scandinaver\Common\Domain\Contract\Repository\LanguageRepositoryInterface;
use Scandinaver\Common\Domain\Contract\UserInterface;
use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\Common\Domain\Service\IntroFactory;
use Scandinaver\Common\Domain\Service\IntroService;
use Scandinaver\Common\Domain\Service\LanguageFactory;
use Scandinaver\Common\Domain\Service\LanguageService;
use Scandinaver\Common\Domain\Service\LanguageTrait;
use Scandinaver\Learn\Domain\Contract\Repository\AssetRepositoryInterface;
use Scandinaver\Learn\Domain\Contract\Repository\FavouriteAssetRepositoryInterface;
use Scandinaver\Learn\Domain\Contract\Repository\PersonalAssetRepositoryInterface;
use Scandinaver\Learn\Domain\Exception\LanguageNotFoundException;
use Scandinaver\Learn\Domain\Model\{Asset, FavouriteAsset};
use Scandinaver\Learn\Domain\Service\AssetFactory;
use Scandinaver\Learn\Domain\Service\AssetService;
use Scandinaver\Puzzle\Domain\Service\PuzzleFactory;
use Scandinaver\Puzzle\Domain\Service\PuzzleService;
use Scandinaver\RBAC\Domain\Contract\Repository\RoleRepositoryInterface;
use Scandinaver\RBAC\Domain\Model\Role;
use Scandinaver\Shared\Contract\BaseServiceInterface;
use Scandinaver\Translate\Domain\Contract\Repository\TextRepositoryInterface;
use Scandinaver\Translate\Domain\Service\TextService;
use Scandinaver\User\Domain\Contract\Repository\PlanRepositoryInterface;
use Scandinaver\User\Domain\Contract\Repository\UserRepositoryInterface;
use Scandinaver\User\Domain\Contract\Service\AvatarServiceInterface;
use Scandinaver\User\Domain\DTO\StateDTO;
use Scandinaver\User\Domain\Exception\UserNotFoundException;
use Scandinaver\User\Domain\Model\{Plan, User};

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

    protected PlanRepositoryInterface $planRepository;

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

    public function __construct(AssetRepositoryInterface $assetRepository,
                                FavouriteAssetRepositoryInterface $favouriteAssetRepository,
                                PersonalAssetRepositoryInterface $personalAssetRepository,
                                AssetService $assetService,
                                UserRepositoryInterface $userRepository,
                                PlanRepositoryInterface $planRepository,
                                LanguageRepositoryInterface $languageRepository,
                                TextRepositoryInterface $textRepository,
                                RoleRepositoryInterface $roleRepository,
                                TextService $textService,
                                PuzzleService $puzzleService,
                                LanguageService $languageService,
                                AvatarServiceInterface $avatarService,
                                IntroService $introService)
    {
        $this->userRepository           = $userRepository;
        $this->planRepository           = $planRepository;
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
    private function getUser(int $id): User
    {
        /** @var User $user */
        $user = $this->userRepository->find($id);
        if ($user === NULL) {
            throw new UserNotFoundException();
        }

        return $user;
    }

    public function all(): array
    {
        /** @var User[] $users */
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
     * @param  array  $data
     *
     * @return User
     * @throws Exception
     */
    public function registration(array $data): User
    {
        /** @var Plan $plan */
        $plan = $this->planRepository->find(1);

        /** @var Language[] $languages */
        $languages = $this->languageRepository->findAll();

        $user = new User();
        $user->setLogin($data['login']);
        $user->setEmail($data['email']);
        $user->setPassword(bcrypt($data['password']));
        $user->setPlan($plan);
        $user->setCreatedAt(Carbon::now());
        $user->setActive(TRUE);
        $user->setActiveTo(Carbon::now());

        if (array_key_exists('_roles', $data)) {
            $roles = $data['_roles'];
            foreach ($roles as $item) {
                /** @var Role $role */
                $role = $this->roleRepository->find($item['_id']);
                $user->attachRole($role);
            }
        }
        else {
            /** @var Role $defaultRole */
            $defaultRole = $this->roleRepository->findOneBy([
                'slug' => 'user',
            ]);

            if ($defaultRole === NULL) {
                throw new Exception('Default role not found');
            }

            $user->attachRole($defaultRole);
        }

        foreach ($languages as $language) {
            $favourite = new FavouriteAsset($language);
            $favourite->setOwner($user);
            $user->addPersonalAsset($favourite);
        }

        $this->userRepository->save($user);

        return $user;
    }

    /**
     * @param  User    $user
     * @param  string  $language
     *
     * @return StateDTO
     * @throws LanguageNotFoundException|BindingResolutionException
     */
    public function getState(User $user, string $language): StateDTO
    {
        $language = $this->getLanguage($language);

        /** @var Asset[] $personalAssets TODO: move to AssetService::getAssetsByType() */
        $personalAssets = $user->getPersonalAssets($language);
        $personalData   = [];
        foreach ($personalAssets as $personalAsset) {
            $dto = AssetFactory::toDTO($personalAsset);

            if ($user->isPremium()) {
                $dto->setActive(TRUE);
                $dto->setAvailable(TRUE);
            }

            if ($personalAsset->isFavorite()) {
                $dto->setActive(TRUE);
                $dto->setAvailable(TRUE);
            }

            $result = $personalAsset->getBestResultForUser($user);
            $dto->setBestResult($result);

            $personalData[] = $dto;
        }

        $favouriteAsset = $user->getFavouriteAsset($language);
        $result         = $favouriteAsset->getBestResultForUser($user);

        $favouriteAssetDTO = AssetFactory::toDTO($favouriteAsset);
        $favouriteAssetDTO->setActive(TRUE);
        $favouriteAssetDTO->setAvailable(TRUE);

        $favouriteAssetDTO->setBestResult($result);

        $stateDTO = new StateDTO();

        $stateDTO->setSite(config('app.MAIN_SITE'));

        $wordAssetsDTO = $this->assetService->getAssetsByType($language->getLetter(), $user, Asset::TYPE_WORDS);
        $stateDTO->setWordsDTO($wordAssetsDTO);

        $sentencesAssetsDTO = $this->assetService->getAssetsByType($language->getLetter(), $user, Asset::TYPE_SENTENCES);
        $stateDTO->setSentencesDTO($sentencesAssetsDTO);

        $stateDTO->setPersonalDTO($personalData);
        $stateDTO->setFavouriteAssetDTO($favouriteAssetDTO);

        $textsDTO = $this->textService->getTextsForUser($language->getLetter(), $user);
        $stateDTO->setTextsDTO($textsDTO);

        $puzzles    = $this->puzzleService->getForUser($language->getLetter(), $user);
        $puzzlesDTO = [];
        foreach ($puzzles as $puzzle) {
            $puzzlesDTO[] = PuzzleFactory::toDTO($puzzle);
        }
        $stateDTO->setPuzzlesDTO($puzzlesDTO);

        $intros    = $this->introService->all();
        $introsDTO = [];
        foreach ($intros as $intro) {
            $introsDTO[] = IntroFactory::toDTO($intro);
        }
        $stateDTO->setIntroDTO($introsDTO);

        $languages    = $this->languageService->all();
        $languagesDTO = [];
        foreach ($languages as $language) {
            $languagesDTO[] = LanguageFactory::toDTO($language);
        }
        $stateDTO->setLanguagesDTO($languagesDTO);

        return $stateDTO;
    }

    public function getInfo(): User
    {
        return Auth::user();
    }

    public function updatePlan(User $user): void
    {
        if ($user->getActiveTo() < Carbon::now()) {
            $plan = $this->planRepository->findByName('Basic');
            $user->setPlan($plan);
        }
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

        if ($data['password'] === NULL) {
            unset($data['password']);
        }

        if (array_key_exists('plan', $data)) {
            $data['plan'] = $this->planRepository->find($data['plan']['id']);
        }

        /** @var User $user */
        $user = $this->userRepository->update($user, $data);

        return $user;
    }

    /**
     * @param  int  $id
     *
     * @throws UserNotFoundException
     */
    public function delete(int $id): void
    {
        /** @var User $user */
        $user = $this->userRepository->find($id);
        if ($user === NULL) {
            throw new UserNotFoundException();
        }

        $user->delete();

        $this->userRepository->delete($user);
    }

}