<?php

namespace App\Services;

use App\Entities\Asset;
use App\Http\Requests\CreateCardRequest;
use App\Models\Card;
use App\Repositories\Asset\AssetRepositoryInterface;
use App\Repositories\Language\LanguageRepositoryInterface;
use Auth;

/**
 * Class CardService
 * @package app\Services
 */
class CardService
{
    /**
     * @var AssetRepositoryInterface
     */
    private $assetRepository;

    /**
     * @var LanguageRepositoryInterface
     */
    private $languageRepository;

    public function __construct(AssetRepositoryInterface $assetRepository, LanguageRepositoryInterface $languageRepository)
    {
        $this->assetRepository = $assetRepository;
        $this->languageRepository = $languageRepository;
    }

    public function create(CreateCardRequest $request)
    {
        $card = Card::create($request->all());

        $card->load(['word', 'translate', 'asset', 'examples']);

        return $card;
    }

    /**
     * возвращает слова набора, транскрипцию и один вариант перевода
     *
     * используется  при редактировании набора на /cards/
     * @param Asset $asset
     * @return array
     */
    public function getCards(Asset $asset)
    {
        $language = $this->languageRepository->get(config('app.lang'));

        $favouriteAsset = $this->assetRepository->getFavouriteAsset($language, Auth::user());

        $cards = $asset->getCards()->toArray();

        foreach($cards as &$c){
            $c->setFavourite(in_array($c->getWord()->getId(), $favouriteAsset->getWordsIds()));
        }

        return ['type' => $asset->getType(), 'cards' => $cards, 'title' => $asset->getTitle()];
    }
}