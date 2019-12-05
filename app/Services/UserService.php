<?php

namespace App\Services;

use App\Models\Plan;
use Carbon\Carbon;
use App\Entities\{User, Asset, Language};
use App\Events\UserRegistered;
use App\Models\Intro;
use App\Models\Text;
use App\Repositories\Asset\AssetRepositoryInterface;
use App\Repositories\Language\LanguageRepositoryInterface;
use App\Repositories\Plan\PlanRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\Text\TextRepositoryInterface;
use Auth;

/**
 * Class UserService
 * @package app\Services
 */
class UserService
{
    protected $user;

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

    public function __construct(
        AssetRepositoryInterface $assetRepository,
        AssetService $assetService,
        UserRepositoryInterface $userRepository,
        PlanRepositoryInterface $planRepository,
        LanguageRepositoryInterface $languageRepository,
        TextRepositoryInterface $textRepository
    )
    {
        $this->userRepository = $userRepository;
        $this->planRepository = $planRepository;
        $this->languageRepository = $languageRepository;
        $this->assetRepository = $assetRepository;
        $this->textRepository = $textRepository;

        $this->assetService = $assetService;
        //dd($this->userRepository->get(1)->getPlan());
    }

    /**
     * @param  array  $data
     * @return User
     */
    public function registration(array $data)
    {
        $plan = $this->planRepository->get(1);

        /** @var \App\Entities\Language[] $languages */
        $languages = $this->languageRepository->all();

        /** @var \App\Entities\User $user */
        $user = new User($data['login'], $data['email'], bcrypt($data['password']), $plan);

        $user = $this->userRepository->save($user);

        foreach($languages as $language){

            //даем пользователю избранное
            $favourite = new Asset('Избранное', false, true, Asset::TYPE_FAVORITES, $language->getName());
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

      //  event(new UserRegistered($user, $data));

      //  activity('public')->causedBy($user)->log('Зарегистрирован пользователь');

        return $user;
    }

    public function getState()
    {
        if(!Auth::check()) return [];

        return [
            'user'      => $this->getInfo(),
            'site'      => config('app.MAIN_SITE'),
            'words'     => $this->assetService->getAssetsByType(Asset::TYPE_WORDS, Auth::user()->id),
            'sentences' => $this->assetService->getAssetsByType(Asset::TYPE_SENTENCES, Auth::user()->id),
            'favourites'=> $this->assetService->getAssetsByType(Asset::TYPE_FAVORITES, Auth::user()->id)[0],
            'personal'  => $this->assetService->getPersonalAssets(Auth::user()->id),

            //'texts'     => Text::select(['id', 'title'])->where('published', '=', '1')->get(),
            'texts'     => Text::getTextsByUser(Auth::user()->id),
            'intro'     => Intro::where('active', '=', '1')->get()->sortBy('sort')->groupBy('page'),
            'sites'     => Language::all(),
            'currentsite' => Language::where('name', config('app.lang'))->first(),
            'domain'    => config('app.lang'),
        ];
    }

    public function getInfo()
    {
        return [
            'id' => Auth::user()->id,
            'login' => Auth::user()->login,
            'avatar' => Auth::user()->avatar,
            'email' => Auth::user()->email,
            'active' => Auth::user()->premium,
            'plan' => Auth::user()->plan,
            'active_to' => Auth::user()->active_to
        ];
    }

    public function updatePlan(User $user)
    {
        if($user->getActiveTo() < Carbon::now()){
            $plan = $this->planRepository->findByName('Basic');
            $user->setPlan($plan);
        }
    }
}