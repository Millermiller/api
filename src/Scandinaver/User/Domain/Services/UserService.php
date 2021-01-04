<?php


namespace Scandinaver\User\Domain\Services;

use Auth;
use Carbon\Carbon;
use Doctrine\Common\Collections\ArrayCollection;
use Exception;
use Scandinaver\Common\Domain\Contract\Repository\LanguageRepositoryInterface;
use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\Common\Domain\Services\IntroService;
use Scandinaver\Common\Domain\Services\LanguageService;
use Scandinaver\Common\Domain\Services\LanguageTrait;
use Scandinaver\Learn\Domain\Contract\Repository\AssetRepositoryInterface;
use Scandinaver\Learn\Domain\Contract\Repository\FavouriteAssetRepositoryInterface;
use Scandinaver\Learn\Domain\Contract\Repository\PersonalAssetRepositoryInterface;
use Scandinaver\Learn\Domain\Exceptions\LanguageNotFoundException;
use Scandinaver\Learn\Domain\Model\Asset;
use Scandinaver\Learn\Domain\Model\FavouriteAsset;
use Scandinaver\Learn\Domain\Model\Result as AssetResult;
use Scandinaver\Learn\Domain\Services\AssetService;
use Scandinaver\Puzzle\Domain\PuzzleService;
use Scandinaver\RBAC\Domain\Contract\Repository\RoleRepositoryInterface;
use Scandinaver\RBAC\Domain\Model\Role;
use Scandinaver\Shared\Contract\BaseServiceInterface;
use Scandinaver\Translate\Domain\Contract\Repository\TextRepositoryInterface;
use Scandinaver\Translate\Domain\Model\Result as TranslateResult;
use Scandinaver\Translate\Domain\TextService;
use Scandinaver\User\Domain\Contract\Repository\PlanRepositoryInterface;
use Scandinaver\User\Domain\Contract\Repository\UserRepositoryInterface;
use Scandinaver\User\Domain\Exceptions\UserNotFoundException;
use Scandinaver\User\Domain\Model\Plan;
use Scandinaver\User\Domain\Model\User;
use Scandinaver\User\Domain\Model\UserDTO;

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

    public function __construct(
      AssetRepositoryInterface $assetRepository,
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
      IntroService $introService
    ) {
        $this->userRepository = $userRepository;
        $this->planRepository = $planRepository;
        $this->languageRepository = $languageRepository;
        $this->assetRepository = $assetRepository;
        $this->textRepository = $textRepository;
        $this->assetService = $assetService;
        $this->textService = $textService;
        $this->puzzleService = $puzzleService;
        $this->favouriteAssetRepository = $favouriteAssetRepository;
        $this->personalAssetRepository = $personalAssetRepository;
        $this->introService = $introService;
        $this->languageService = $languageService;
        $this->roleRepository = $roleRepository;
    }

    /**
     * @param  int  $id
     *
     * @return UserDTO
     * @throws UserNotFoundException
     */
    public function one(int $id): UserDTO
    {
        $user = $this->getUser($id);

        return $user->toDTO();
    }

    public function all(): array
    {
        $result = [];

        /** @var User[] $users */
        $users = $this->userRepository->findAll();

        foreach ($users as $user) {
            $result[] = $user->toDTO();
        }

        return $result;
    }

    /**
     * @param  array  $credentials
     *
     * @return User|null
     * @throws UserNotFoundException
     */
    public function login(array $credentials): ?User
    {
        if (!Auth::attempt($credentials)) {
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
        $user->setLogin($data['_login']);
        $user->setEmail($data['_email']);
        $user->setPassword(bcrypt($data['_password']));
        $user->setPlan($plan);
        $user->setCreatedAt(Carbon::now());
        $user->setActive(true);
        $user->setActiveTo(Carbon::now());

        if (array_key_exists('_roles', $data)) {
            $roles = $data['_roles'];
            foreach ($roles as $item) {
                /** @var Role $role */
                $role = $this->roleRepository->find($item['_id']);
                $user->attachRole($role);
            }
        }

        foreach ($languages as $language) {
            //даем пользователю избранное
            $favourite = new FavouriteAsset($language);
            $result = new AssetResult($favourite, $user, $language);
            $user->addTest($result);

            //даем пользователю первый словарь слов
            $firstWordAsset = $this->assetRepository->getFirstAsset(
              $language,
              Asset::TYPE_WORDS
            );
            $result = new AssetResult($firstWordAsset, $user, $language);
            $user->addTest($result);

            //даем пользователю первый словарь предложений
            $firstSentencesAsset = $this->assetRepository->getFirstAsset(
              $language,
              Asset::TYPE_SENTENCES
            );
            $result = new AssetResult($firstSentencesAsset, $user, $language);
            $user->addTest($result);

            //даем пользователю первый текст
            $firstText = $this->textRepository->getFirstText($language);
            $result = new TranslateResult($firstText, $user, $language);
            $user->addTranslate($result);
        }

        $this->userRepository->save($user);

        // event(new UserRegistered($user, $data));

        return $user;
    }

    /**
     * @param  User  $user
     * @param  string  $language
     *
     * @return array
     * @throws LanguageNotFoundException
     */
    public function getState(User $user, string $language): array
    {
        $language = $this->getLanguage($language);

        return [
          'site' => config('app.MAIN_SITE'),
          'words' => $this->assetService->getAssetsByType(
            $language->getName(),
            $user,
            Asset::TYPE_WORDS
          ),
          'sentences' => $this->assetService->getAssetsByType(
            $language->getName(),
            $user,
            Asset::TYPE_SENTENCES
          ),
          'favourites' => $user->getFavouriteAsset($language)->toDTO(),
          'personal' => $user->getCreatedAssets($language),
          'texts' => $this->textService->getTextsForUser(
            $language->getName(),
            $user
          ),
          'puzzles' => $this->puzzleService->getForUser(
            $language->getName(),
            $user
          ),
          'intro' => $this->introService->all(),
          'sites' => $this->languageService->all(),
          'currentSite' => $this->languageRepository->findOneBy(
            ['name' => config('app.lang')]
          ),
          'domain' => config('app.lang'),
        ];
    }

    public function getInfo(): array
    {
        return [
          'id' => Auth::user()->getKey(),
          'login' => Auth::user()->getLogin(),
          'avatar' => Auth::user()->getAvatar(),
          'email' => Auth::user()->getEmail(),
          'active' => Auth::user()->getActive(),
          'plan' => Auth::user()->getPlan(),
          'active_to' => Auth::user()->getActiveTo(),
          'roles' => Auth::user()->getRoles()->map(
            fn($role) => $role->toDTO()
          )->toArray(),
          'permissions' => Auth::user()->getAllPermissions()->map(
            fn($permission) => $permission->toDTO()
          )->toArray(),
        ];
    }

    public function updatePlan(User $user): void
    {
        if ($user->getActiveTo() < Carbon::now()) {
            $plan = $this->planRepository->findByName('Basic');
            $user->setPlan($plan);
        }
    }

    public function updateUserInfo(array $request): void
    {
        $user = Auth::user();

        //Requester::updateForumUser($request, $user->getEmail());

        $request['password'] = isset($request['password']) ? bcrypt(
          $request['password']
        ) : $user->getPassword();

        $this->userRepository->update($user, $request);
    }

    /**
     * @param  int  $id
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

        $data['plan'] = $this->planRepository->find($data['plan']['id']);

        return $this->userRepository->update($user, $data);
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
        if ($user === null) {
            throw new UserNotFoundException();
        }

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
        if ($user === null) {
            throw new UserNotFoundException();
        }

        $user->delete();

        $this->userRepository->delete($user);

        // event(new UserDeleted($user));
    }

}