<?php


namespace Scandinaver\Learn\Domain\Services;

use Doctrine\Common\Collections\Collection;
use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\Learn\Domain\Model\{Asset,
    Card,
    Example,
    Translate,
    Word
};
use Scandinaver\Learn\Domain\Contract\Repository\AssetRepositoryInterface;
use Scandinaver\Learn\Domain\Contract\Repository\CardRepositoryInterface;
use Scandinaver\Learn\Domain\Contract\Repository\ExampleRepositoryInterface;
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

    /**
     * CardService constructor.
     *
     * @param  AssetRepositoryInterface      $assetRepository
     * @param  CardRepositoryInterface       $cardRepository
     * @param  ResultRepositoryInterface     $resultRepository
     * @param  ExampleRepositoryInterface    $exampleRepository
     * @param  TranslateRepositoryInterface  $translateRepository
     */
    public function __construct(
        AssetRepositoryInterface $assetRepository,
        CardRepositoryInterface $cardRepository,
        ResultRepositoryInterface $resultRepository,
        ExampleRepositoryInterface $exampleRepository,
        TranslateRepositoryInterface $translateRepository
    ) {
        $this->assetRepository = $assetRepository;
        $this->cardRepository = $cardRepository;
        $this->resultRepository = $resultRepository;
        $this->exampleRepository = $exampleRepository;
        $this->translateRepository = $translateRepository;
    }

    /**
     * @param  Word       $word
     * @param  Translate  $translate
     * @param  Asset      $asset
     *
     * @return Card
     */
    public function createCard(
        Word $word,
        Translate $translate,
        Asset $asset
    ): Card {
        $card = new Card($word, $asset, $translate);
        $card->setAsset($asset);
        $this->cardRepository->save($card);

        return $card;
    }

    /**
     * @param  Card       $card
     * @param  Word       $word
     * @param  Translate  $translate
     * @param  Asset      $asset
     *
     * @return Card
     */
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

    /**
     * @param  Card  $card
     */
    public function destroyCard(Card $card)
    {
        $this->cardRepository->delete($card);
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
        $favouriteAsset = $this->assetRepository->getFavouriteAsset(
            $language,
            $user
        );

        $result = $this->resultRepository->getResult($user, $asset);

        $cards = $asset->getCards()->toArray();

        foreach ($cards as &$c) {
            $c->setFavourite(
                in_array($c->getWord()->getId(), $favouriteAsset->getWordsIds())
            );
        }

        return [
            'id' => $asset->getId(),
            'type' => $asset->getType(),
            'cards' => $cards,
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

    /**
     * @param  Card    $card
     * @param  string  $text
     * @param  string  $value
     *
     * @return Example
     */
    public function addExample(Card $card, string $text, string $value): Example
    {
        $example = new Example($text, $value, $card);

        $this->exampleRepository->save($example);

        return $example;
    }

    /**
     * @param  Card  $card
     */
    public function deleteExamplesOfCard(Card $card)
    {
        foreach ($card->getExamples() as $example) {
            $this->exampleRepository->delete($example);
        }
    }

    /**
     * @param  Translate  $translate
     * @param  string     $text
     *
     * @return Translate
     */
    public function editTranslate(Translate $translate, string $text): Translate
    {
        $translate->setValue($text);
        $this->translateRepository->save($translate);

        return $translate;
    }
}