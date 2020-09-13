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
use Scandinaver\Learn\Domain\Contract\Repository\WordRepositoryInterface;
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

    private CardFactory $cardFactory;

    private FavouriteAssetRepositoryInterface $favouriteAssetRepository;
    private WordRepositoryInterface $wordRepository;

    public function __construct(
        AssetRepositoryInterface $assetRepository,
        CardRepositoryInterface $cardRepository,
        ResultRepositoryInterface $resultRepository,
        ExampleRepositoryInterface $exampleRepository,
        TranslateRepositoryInterface $translateRepository,
        FavouriteAssetRepositoryInterface $favouriteAssetRepository,
        WordRepositoryInterface $wordRepository,
        CardFactory $cardFactory
    ) {
        $this->assetRepository = $assetRepository;
        $this->cardRepository = $cardRepository;
        $this->resultRepository = $resultRepository;
        $this->exampleRepository = $exampleRepository;
        $this->translateRepository = $translateRepository;
        $this->cardFactory = $cardFactory;
        $this->favouriteAssetRepository = $favouriteAssetRepository;
        $this->wordRepository = $wordRepository;
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

        $card = $this->cardFactory->build($data);

        $this->cardRepository->save($card);

        return $card;
    }

    public function updateCard(Card $card, array $data): Card
    {
        $translate = $card->getTranslate();
        $translate->setValue($data['translate']['value']);
        $this->translateRepository->save($translate);

        $word = $card->getWord();
        $word->setValue($data['word']['value']);
        $this->wordRepository->save($word);

        $card->clearExamples();

        foreach ($data['examples'] as $exampleData) {
            if (isset($exampleData['id'])) {
                /** @var Example $example */
                $example = $this->exampleRepository->find($exampleData['id']);
                if ($example === null) {
                    $example = new Example($exampleData['text'], $exampleData['value'], $card);
                }
                else {
                    $example->setText($exampleData['text']);
                    $example->setValue($exampleData['value']);
                }
            }
            else {
                $example = new Example($exampleData['text'], $exampleData['value'], $card);
            }
            $this->exampleRepository->save($example);
            $card->addExample($example);
        }

        $this->cardRepository->save($card);

        return $card;
    }

    public function removeCardFromAsset(Card $card, Asset $asset): void
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