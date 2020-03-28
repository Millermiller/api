<?php


namespace Scandinaver\User\Domain\Services;

use App\Events\{UserDeleted, UserRegistered};
use Auth;
use Carbon\Carbon;
use Doctrine\Common\Collections\ArrayCollection;
use Exception;
use Illuminate\Contracts\Auth\Authenticatable;
use Scandinaver\Common\Domain\Contracts\{IntroRepositoryInterface, LanguageRepositoryInterface};
use Scandinaver\Common\Domain\Language;
use Scandinaver\Learn\Domain\Asset;
use Scandinaver\Learn\Domain\Contracts\AssetRepositoryInterface;
use Scandinaver\Learn\Domain\Services\AssetService;
use Scandinaver\Text\Domain\Contracts\TextRepositoryInterface;
use Scandinaver\Text\Domain\TextService;
use Scandinaver\User\Domain\Contracts\{PlanRepositoryInterface, UserRepositoryInterface};
use Scandinaver\User\Domain\Exceptions\UserNotFoundException;
use Scandinaver\User\Domain\User;

/**
 * Class UserService
 *
 * @package app\Services
 */
class UserService
{
    /**
     * @var AssetService
     */
    protected $assetService;

    /**
     * @var UserRepositoryInterface
     */
    protected $userRepository;

    /**
     * @var PlanRepositoryInterface
     */
    protected $planRepository;

    /**
     * @var LanguageRepositoryInterface
     */
    protected $languageRepository;

    /**
     * @var AssetRepositoryInterface
     */
    protected $assetRepository;

    /**
     * @var TextRepositoryInterface
     */
    protected $textRepository;

    /**
     * @var IntroRepositoryInterface
     */
    protected $introRepository;

    /**
     * @var
     */
    private $textService;

    /**
     * UserService constructor.
     *
     * @param AssetRepositoryInterface    $assetRepository
     * @param AssetService                $assetService
     * @param UserRepositoryInterface     $userRepository
     * @param PlanRepositoryInterface     $planRepository
     * @param LanguageRepositoryInterface $languageRepository
     * @param TextRepositoryInterface     $textRepository
     * @param IntroRepositoryInterface    $introRepository
     * @param TextService                 $textService
     */
    public function __construct(
        AssetRepositoryInterface $assetRepository,
        AssetService $assetService,
        UserRepositoryInterface $userRepository,
        PlanRepositoryInterface $planRepository,
        LanguageRepositoryInterface $languageRepository,
        TextRepositoryInterface $textRepository,
        IntroRepositoryInterface $introRepository,
        TextService $textService
    )
    {
        $this->userRepository     = $userRepository;
        $this->planRepository     = $planRepository;
        $this->languageRepository = $languageRepository;
        $this->assetRepository    = $assetRepository;
        $this->textRepository     = $textRepository;
        $this->introRepository    = $introRepository;
        $this->assetService       = $assetService;
        $this->textService        = $textService;
    }

    /**
     * @return array
     */
    public function getAll(): array
    {
        return $this->userRepository->all();
    }

    /**
     * @param string $string
     *
     * @return array
     */
    public function find($string): array
    {
        return $this->userRepository->findByNameOrEmail($string);
    }

    /**
     * @param array $credentials
     *
     * @return Authenticatable|User|null
     * @throws UserNotFoundException
     * @throws Exception
     */
    public function login(array $credentials): ?User
    {
        if (!Auth::attempt($credentials)) {
            throw new UserNotFoundException();
        }
        return \App\Helpers\Auth::user();
    }

    /**
     * @param array $data
     *
     * @return User
     * @throws Exception
     */
    public function registration(array $data): User
    {
        $plan = $this->planRepository->get(1);

        /** @var Language[] $languages */
        $languages = $this->languageRepository->all();

        $user = new User();
        $user->setAssets(new ArrayCollection());
        $user->setTexts(new ArrayCollection());
        $user->setLogin($data['login']);
        $user->setEmail($data['email']);
        $user->setPassword(bcrypt($data['password']));
        $user->setPlan($plan);
        $user->setCreatedAt(Carbon::now()->format("Y-m-d H:i:s"));
        $user = $this->userRepository->save($user);

        foreach ($languages as $language) {

            //даем пользователю избранное
            $favourite = new Asset('Избранное', false, Asset::TYPE_FAVORITES, 1, $language);
            $favourite = $this->assetRepository->save($favourite);
            $this->userRepository->addAsset($user, $favourite);

            //даем пользователю первый словарь слов
            $firstWordAsset = $this->assetRepository->getFirstAsset($language, Asset::TYPE_WORDS);
            $this->userRepository->addAsset($user, $firstWordAsset);

            //даем пользователю первый словарь предложений
            $firstSentencesAsset = $this->assetRepository->getFirstAsset($language, Asset::TYPE_SENTENCES);
            $this->userRepository->addAsset($user, $firstSentencesAsset);

            //даем пользователю первый текст
            $firstText = $this->textRepository->getFirstText($language);
            $this->userRepository->addText($user, $firstText);
        }

        event(new UserRegistered($user, $data));

        return $user;
    }

    /**
     * @param Authenticatable|User $user
     * @param Language             $language
     *
     * @return array
     * @throws Exception
     */
    public function getState(User $user, Language $language): array
    {
        return [
            'user'       => $this->getInfo(),
            'site'       => config('app.MAIN_SITE'),
            'words'      => $this->assetService->getAssetsByType($language, $user, Asset::TYPE_WORDS),
            'sentences'  => $this->assetService->getAssetsByType($language, $user, Asset::TYPE_SENTENCES),
            'favourites' => $this->assetRepository->getFavouriteAsset($language, $user),
            'personal'   => $this->assetRepository->getCreatedAssets($language, $user),

            'texts'       => $this->textService->getTextsForUser($user),
            'intro'       => $this->introRepository->getGrouppedIntro(),
            'sites'       => $this->languageRepository->all(),
            'currentsite' => $this->languageRepository->findOneBy(['name' => config('app.lang')]),
            'domain'      => config('app.lang'),
        ];
    }

    /**
     * @return array
     */
    public function getInfo(): array
    {
        return [
            'id'        => Auth::user()->getKey(),
            'login'     => Auth::user()->getLogin(),
            'avatar'    => Auth::user()->getAvatar(),
            'email'     => Auth::user()->getEmail(),
            'active'    => Auth::user()->getActive(),
            'plan'      => Auth::user()->getPlan(),
            'active_to' => Auth::user()->getActiveTo()
        ];
    }

    /**
     * @param User $user
     *
     * @return void
     */
    public function updatePlan(User $user): void
    {
        if ($user->getActiveTo() < Carbon::now()) {
            $plan = $this->planRepository->findByName('Basic');
            $user->setPlan($plan);
        }
    }

    /**
     * @param array $request
     *
     * @return void
     */
    public function updateUserInfo(array $request): void
    {
        $user = Auth::user();

        //Requester::updateForumUser($request, $user->getEmail());

        $request['password'] = isset($request['password']) ? bcrypt($request['password']) : $user->getPassword();

        $this->userRepository->update($user, $request);
    }

    /**
     * @param User  $user
     * @param array $data
     *
     * @return User
     */
    public function updateUser(User $user, array $data): User
    {
        $data['plan'] = $this->planRepository->get($data['plan']['id']);

        return $this->userRepository->update($user, $data);
    }

    /**
     * @param User $user
     *
     * @return void
     */
    public function delete(User $user): void
    {
        $this->userRepository->delete($user);

        event(new UserDeleted($user));
    }

    /**
     * @param int $id
     *
     * @return User
     */
    public function getOne(int $id): User
    {
        return $this->userRepository->get($id);
    }
}