<?php

namespace App\Services;

use App\Models\Asset;
use App\Models\Intro;
use App\Models\Language;
use App\Models\Text;
use Auth;

/**
 * Class UserService
 * @package app\Services
 */
class UserService
{
    protected $user;

    protected $assetService;

    public function __construct(AssetService $assetService)
    {
        $this->assetService = $assetService;
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
}