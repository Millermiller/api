<?php

namespace App\Services;

use App\Models\Asset;
use App\Repositories\Asset\AssetRepositoryInterface;
use App\Repositories\Language\LanguageRepositoryInterface;
use App\Repositories\Result\ResultRepositoryInterface;

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

    /**
     * @var ResultRepositoryInterface
     */
    protected $resultRepository;

    public function __construct(LanguageRepositoryInterface $languageRepository, AssetRepositoryInterface $assetsRepository, ResultRepositoryInterface $resultRepository)
    {
        $this->languageRepository = $languageRepository;
        $this->assetsRepository = $assetsRepository;
        $this->resultRepository = $resultRepository;
    }

    /**
     * @return array
     */
    public function getLanguagesList(): array
    {
        return $this->languageRepository->all();
    }

    /**
     * @param $language
     * @return array
     */
    public function getAssets($language)
    {
        $language = $this->languageRepository->getByName($language);

        /** @var \App\Entities\User $user */
        $user = auth('api')->user();

        $assets = [];

        $activeArray  = $this->resultRepository->getActiveIds($user, $language);

        $personaldata = $this->assetsRepository->getPersonalAssets($language, $user);

        $publicdata   = $this->assetsRepository->getPublicAssets($language);

        $data = $publicdata + $personaldata;

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
                $word = $card->getWord();

                if($word === null) continue;

                $cards[] = [
                    'id' => $card->getId(),
                    'word' => $word->getValue(),
                    'trans' =>  preg_replace('/^(\d\\)\s)/', '',  $card->getTranslate()->getValue()),
                    'asset_id' => $card->getAsset()->getId(),
                    'examples' => $card->getExamples()
                ];
            }

            $asset = [
                'id' => $item->getId(),
                'active' => in_array($item->getId(), $activeArray),
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