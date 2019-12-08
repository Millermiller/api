<?php

namespace App\Services;

use App\Entities\Asset;
use App\Http\Requests\CreateCardRequest;
use App\Entities\Card;
use App\Repositories\Asset\AssetRepositoryInterface;
use App\Repositories\Card\CardRepositoryInterface;
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

    /**
     * @var CardRepositoryInterface
     */
    private $cardRepository;

    public function __construct(AssetRepositoryInterface $assetRepository, LanguageRepositoryInterface $languageRepository, CardRepositoryInterface $cardRepository)
    {
        $this->assetRepository = $assetRepository;
        $this->languageRepository = $languageRepository;
        $this->cardRepository = $cardRepository;
    }

    public function create(CreateCardRequest $request)
    {
        $card = Card::create($request->all());

        $card->load(['word', 'translate', 'asset', 'examples']);

        return $card;
    }

    /**
     * @param Card $card
     */
    public function destroyCard(Card $card)
    {
        $this->cardRepository->delete($card);
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