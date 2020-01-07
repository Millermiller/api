<?php


namespace Scandinaver\Learn\Domain\Services;

use App\Entities\User;
use Scandinaver\Learn\Domain\{Asset,
    Card,
    Contracts\AssetRepositoryInterface,
    Contracts\CardRepositoryInterface,
    Contracts\TranslateRepositoryInterface,
    Contracts\WordRepositoryInterface};
use App\Repositories\Language\LanguageRepositoryInterface;

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

    /**
     * @var WordRepositoryInterface
     */
    private $wordRepository;

    /**
     * @var TranslateRepositoryInterface
     */
    private $translateRepository;

    /**
     * CardService constructor.
     * @param AssetRepositoryInterface $assetRepository
     * @param LanguageRepositoryInterface $languageRepository
     * @param CardRepositoryInterface $cardRepository
     * @param WordRepositoryInterface $wordRepository
     * @param TranslateRepositoryInterface $translateRepository
     */
    public function __construct(
        AssetRepositoryInterface $assetRepository,
        LanguageRepositoryInterface $languageRepository,
        CardRepositoryInterface $cardRepository,
        WordRepositoryInterface $wordRepository,
        TranslateRepositoryInterface $translateRepository
    )
    {
        $this->assetRepository     = $assetRepository;
        $this->languageRepository  = $languageRepository;
        $this->cardRepository      = $cardRepository;
        $this->wordRepository      = $wordRepository;
        $this->translateRepository = $translateRepository;
    }

    /**
     * @param array $data
     * @return Card
     */
    public function createCard(array $data)
    {
        $word = $this->wordRepository->get($data['word_id']);
        $translate = $this->translateRepository->get($data['translate_id']);
        $asset = $this->assetRepository->get($data['asset_id']);

        $card = new Card($word, $asset, $translate);
        $card->setAssetId($asset->getId());
        $this->cardRepository->save($card);

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
     * @param User $user
     * @param Asset $asset
     * @return array
     */
    public function getCards(User $user, Asset $asset): array
    {
        $language = $this->languageRepository->get(config('app.lang'));

        $favouriteAsset = $this->assetRepository->getFavouriteAsset($language, $user);

        $cards = $asset->getCards()->toArray();

        foreach($cards as &$c){
            $c->setFavourite(in_array($c->getWord()->getId(), $favouriteAsset->getWordsIds()));
        }

        return ['type' => $asset->getType(), 'cards' => $cards, 'title' => $asset->getTitle()];
    }
}