<?php


namespace Scandinaver\Learn\Domain\Services;

use Scandinaver\Common\Domain\Contracts\LanguageRepositoryInterface;
use Scandinaver\User\Domain\User;
use Scandinaver\Learn\Domain\{Asset,
    Card,
    Contracts\AssetRepositoryInterface,
    Contracts\CardRepositoryInterface,
    Contracts\ResultRepositoryInterface,
    Translate,
    Word};

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
     * @var ResultRepositoryInterface
     */
    private $resultRepository;

    /**
     * CardService constructor.
     * @param AssetRepositoryInterface $assetRepository
     * @param LanguageRepositoryInterface $languageRepository
     * @param CardRepositoryInterface $cardRepository
     * @param ResultRepositoryInterface $resultRepository
     */
    public function __construct(
        AssetRepositoryInterface $assetRepository,
        LanguageRepositoryInterface $languageRepository,
        CardRepositoryInterface $cardRepository,
        ResultRepositoryInterface $resultRepository
    )
    {
        $this->assetRepository     = $assetRepository;
        $this->languageRepository  = $languageRepository;
        $this->cardRepository      = $cardRepository;
        $this->resultRepository = $resultRepository;
    }

    /**
     * @param Word $word
     * @param Translate $translate
     * @param Asset $asset
     * @return Card
     */
    public function createCard(Word $word, Translate $translate, Asset $asset): Card
    {
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

        $result = $this->resultRepository->getResult($user, $asset);

        $cards = $asset->getCards()->toArray();

        foreach($cards as &$c){
            $c->setFavourite(in_array($c->getWord()->getId(), $favouriteAsset->getWordsIds()));
        }

        return [
            'type' => $asset->getType(),
            'cards' => $cards,
            'title' => $asset->getTitle(),
            'result' => $result->getValue(),
            'level' => $asset->getLevel(),
        ];
    }
}