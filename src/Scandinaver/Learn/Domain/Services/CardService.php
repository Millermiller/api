<?php


namespace Scandinaver\Learn\Domain\Services;

use Doctrine\Common\Collections\Collection;
use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\Learn\Domain\Model\{Asset, Card, Example, Translate, Word};
use Scandinaver\Learn\Domain\Contract\Repository\AssetRepositoryInterface;
use Scandinaver\Learn\Domain\Contract\Repository\CardRepositoryInterface;
use Scandinaver\Learn\Domain\Contract\Repository\ExampleRepositoryInterface;
use Scandinaver\Learn\Domain\Contract\Repository\FavouriteAssetRepositoryInterface;
use Scandinaver\Learn\Domain\Contract\Repository\ResultRepositoryInterface;
use Scandinaver\Learn\Domain\Contract\Repository\TranslateRepositoryInterface;
use Scandinaver\User\Domain\Model\User;

/**
 * Class CardService
 *
 * @package Scandinaver\Learn\Domain\Services
 */
class CardService
{
    private AssetRepositoryInterface $assetRepository;

    private CardRepositoryInterface $cardRepository;

    private ResultRepositoryInterface $resultRepository;

    private TranslateRepositoryInterface $translateRepository;

    private ExampleRepositoryInterface $exampleRepository;

    private CardFabric $cardFabric;

    private FavouriteAssetRepositoryInterface $favouriteAssetRepository;

    public function __construct(
        AssetRepositoryInterface $assetRepository,
        CardRepositoryInterface $cardRepository,
        ResultRepositoryInterface $resultRepository,
        ExampleRepositoryInterface $exampleRepository,
        TranslateRepositoryInterface $translateRepository,
        FavouriteAssetRepositoryInterface $favouriteAssetRepository,
        CardFabric $cardFabric
    ) {
        $this->assetRepository = $assetRepository;
        $this->cardRepository = $cardRepository;
        $this->resultRepository = $resultRepository;
        $this->exampleRepository = $exampleRepository;
        $this->translateRepository = $translateRepository;
        $this->cardFabric = $cardFabric;
        $this->favouriteAssetRepository = $favouriteAssetRepository;
    }

    public function addCardToAsset(User $user, Language $language, Card $card, Asset $asset): Card
    {
        $repository = AssetRepositoryFactory::getByType($asset->getType());

        $asset->addCard($card);

        $repository->save($asset);

        return $card;
    }

    public function createCard(User $user, Language $language, string $word, string $translate): Card
    {
        $data = [
            'word' => $word,
            'translate' => $translate,
            'creator' => $user,
            'language' => $language,
        ];

        $card = $this->cardFabric->build($data);

        $this->cardRepository->save($card);

        return $card;
    }

    public function updateCard(
        Card $card,
        Word $word,
        Translate $translate,
        Asset $asset
    ): Card {
        $card->setWord($word);
        $card->setTranslate($translate);
        $card->setAsset($asset);
        $this->cardRepository->save($card);

        return $card;
    }

    public function destroyCard(Card $card, Asset $asset): void
    {
        $asset->removeCard($card);
        $this->assetRepository->save($asset);
    }

    /**
     * возвращает слова набора, транскрипцию и один вариант перевода
     * используется  при редактировании набора на /cards/
     *
     * @param  Language  $language
     * @param  User      $user
     * @param  Asset     $asset
     *
     * @return array
     */
    public function getCards(
        Language $language,
        User $user,
        Asset $asset
    ): array {
        $favouriteAsset = $this->favouriteAssetRepository->getFavouriteAsset(
            $language,
            $user
        );

        $result = $this->resultRepository->getResult($user, $asset);

        $cards = $asset->getCards();

        $cardsDTO = [];

        foreach ($cards as &$card) {
            $card->setFavourite(
                in_array($card->getWord()->getId(), $favouriteAsset->getWordsIds())
            );
            $cardsDTO[] = $card->toDTO();
        }

        return [
            'id' => $asset->getId(),
            'type' => $asset->getType(),
            'cards' => $cardsDTO,
            'title' => $asset->getTitle(),
            'result' => $result->getValue(),
            'level' => $asset->getLevel(),
        ];
    }

    /**
     * @param  Card  $card
     *
     * @return Collection|Example[]|array
     */
    public function getExamples(Card $card): array
    {
        return $card->getExamples();
    }

    public function addExample(Card $card, string $text, string $value): Example
    {
        $example = new Example($text, $value, $card);

        $this->exampleRepository->save($example);

        return $example;
    }

    public function deleteExamplesOfCard(Card $card)
    {
        foreach ($card->getExamples() as $example) {
            $this->exampleRepository->delete($example);
        }
    }

    public function editTranslate(Translate $translate, string $text): Translate
    {
        $translate->setValue($text);
        $this->translateRepository->save($translate);

        return $translate;
    }
}