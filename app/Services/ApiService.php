<?php

namespace App\Services;

use App\Models\Asset;;
use App\Models\Example;
use App\Models\Result;
use App\Repositories\Asset\AssetRepositoryInterface;
use App\Repositories\Language\LanguageRepositoryInterface;
use App\User;

/**
 * Class ApiService
 * @package app\Services
 */
class ApiService
{
    /**
     * @var LanguageRepositoryInterface
     */
    protected $languageRepository;

    /**
     * @var AssetRepositoryInterface
     */
    protected $assetsRepository;

    public function __construct(LanguageRepositoryInterface $languageRepository, AssetRepositoryInterface $assetsRepository)
    {
        $this->languageRepository = $languageRepository;
        $this->assetsRepository = $assetsRepository;
    }

    /**
     * @return array
     */
    public function getLanguagesList() : array
    {
        return $this->languageRepository->all();
    }

    /**
     * @param $language
     * @return array
     */
    public function getAssets($language)
    {
        config(['app.lang' => $language]);

        $language = $this->languageRepository->getByName($language);

        /** @var \App\Entities\User $user */
        $user = auth('api')->user();

        $assets = [];

      //  $activeArray = Result::domain()->where('user_id', $user->id)->pluck('result', 'asset_id')->toArray();
        $activeArray = [];

    //    $personaldata = Asset::domain()->whereHas('result', function ($q) use ($user) {
    //        /** @var \Illuminate\Database\Eloquent\Builder $q*/
    //        $q->where('user_id', $user->id);
    //    })->with('cards', 'cards.word', 'cards.translate', 'result')->get();
    //      $publicdata = Asset::domain()->with('cards', 'cards.word', 'cards.translate', 'result')->where('basic', 1)->get();


       // $personaldata = $this->assetsRepository->getPersonalAssets($language, $user);
        $publicdata = $this->assetsRepository->getPublicAssets($language);
        var_dump($publicdata);die;
      //  $data = array_merge($personaldata, $publicdata);

        $data = $publicdata;

        $counter = [
            Asset::TYPE_WORDS => 0,
            Asset::TYPE_SENTENCES => 0,
            Asset::TYPE_PERSONAL => 0,
            Asset::TYPE_FAVORITES => 0,
        ];

        foreach ($data as $item) {
            $cards = [];

            /** @var \App\Entities\Asset $item */
            foreach ($item->getCards() as $card) {
                if(! $card->getWord()->getValue()) continue;

                $cards[] = [
                    'id' => $card->getId(),
                    'word' => $card->getWord()->getValue(),
                    'trans' =>  preg_replace('/^(\d\\)\s)/', '',  $card->getTranslate()->getValue()),
                    'asset_id' => $card->getAsset()->getId(),
                    'examples' => $card->getExamples()
                ];
            }

            $asset = [
                'id' => $item->getId(),
                'active' => in_array($item->getId(), array_keys($activeArray)),
                'count' => $item->getCards()->count(),
                'result' => 0,
                'level' => $item->getLevel(),
                'title' => $item->getTitle(),
                'type' => $item->getType(),
                'basic' => $item->getBasic(),
                'cards' => $cards
            ];

            $counter[$item->getType()] = $counter[$item->getType()] + 1;

            if((in_array($item->getType(), [Asset::TYPE_WORDS, Asset::TYPE_SENTENCES]) && $counter[$item->getType()] < 10) || $user->isPremium() || in_array($item->getType(), [Asset::TYPE_FAVORITES, Asset::TYPE_PERSONAL]))
                $asset['available'] = true;
            else
                $asset['available'] = false;

            $assets[] = $asset;
        }

        return $assets;
    }
}