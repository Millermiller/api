<?php


namespace Scandinaver\Learn\Domain\Services;

use Doctrine\Common\Collections\Collection;
use Scandinaver\Learn\Domain\Model\{Card, Example, Translate, Word};
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Scandinaver\Common\Domain\Services\LanguageTrait;
use Scandinaver\Learn\Domain\Contract\Repository\AssetRepositoryInterface;
use Scandinaver\Learn\Domain\Contract\Repository\CardRepositoryInterface;
use Scandinaver\Learn\Domain\Contract\Repository\ExampleRepositoryInterface;
use Scandinaver\Learn\Domain\Contract\Repository\FavouriteAssetRepositoryInterface;
use Scandinaver\Learn\Domain\Contract\Repository\ResultRepositoryInterface;
use Scandinaver\Learn\Domain\Contract\Repository\TranslateRepositoryInterface;
use Scandinaver\Learn\Domain\Contract\Repository\WordRepositoryInterface;
use Scandinaver\Learn\Domain\Contract\Service\TranslaterInterface;
use Scandinaver\User\Domain\Model\User;
use Storage;

/**
 * Class CardService
 *
 * @package Scandinaver\Learn\Domain\Services
 */
class CardService
{
    use LanguageTrait;
    use AssetTrait;
    use CardTrait;

    private AssetRepositoryInterface $assetRepository;

    private CardRepositoryInterface $cardRepository;

    private ResultRepositoryInterface $resultRepository;

    private TranslateRepositoryInterface $translateRepository;

    private ExampleRepositoryInterface $exampleRepository;

    private CardFactory $cardFactory;

    private FavouriteAssetRepositoryInterface $favouriteAssetRepository;

    private WordRepositoryInterface $wordRepository;

    private TranslaterInterface $translater;

    public function __construct(
        AssetRepositoryInterface $assetRepository,
        CardRepositoryInterface $cardRepository,
        ResultRepositoryInterface $resultRepository,
        ExampleRepositoryInterface $exampleRepository,
        TranslateRepositoryInterface $translateRepository,
        FavouriteAssetRepositoryInterface $favouriteAssetRepository,
        WordRepositoryInterface $wordRepository,
        CardFactory $cardFactory,
        TranslaterInterface $translater
    ) {
        $this->assetRepository = $assetRepository;
        $this->cardRepository = $cardRepository;
        $this->resultRepository = $resultRepository;
        $this->exampleRepository = $exampleRepository;
        $this->translateRepository = $translateRepository;
        $this->cardFactory = $cardFactory;
        $this->favouriteAssetRepository = $favouriteAssetRepository;
        $this->wordRepository = $wordRepository;
        $this->translater = $translater;
    }

    public function addCardToAsset(User $user, string $language, int $card, int $asset): Card
    {
        $asset = $this->getAsset($asset);
        $card = $this->getCard($card);

        $repository = AssetRepositoryFactory::getByType($asset->getType());

        $asset->addCard($card);

        $repository->save($asset);

        return $card;
    }

    public function createCard(User $user, string $language, string $word, string $translate): Card
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

    public function updateCard(int $card, array $data): Card
    {
        $card = $this->getCard($card);

        $card->setWordValue($data['word']['value']);

        $card->setTranslateValue($data['translate']['value']);

        $card->clearExamples();

        foreach ($data['examples'] as $exampleData) {
            if (isset($exampleData['id'])) {
                /** @var Example $example */
                $example = $this->exampleRepository->find($exampleData['id']);
                if ($example === null) {
                    $example = new Example($exampleData['text'], $exampleData['value'], $card);
                } else {
                    $example->setText($exampleData['text']);
                    $example->setValue($exampleData['value']);
                }
            } else {
                $example = new Example($exampleData['text'], $exampleData['value'], $card);
            }
            $this->exampleRepository->save($example);
            $card->addExample($example);
        }

        $this->cardRepository->save($card);

        return $card;
    }

    public function removeCardFromAsset(int $card, int $asset): void
    {
        $asset = $this->getAsset($asset);
        $card = $this->getCard($card);

        $asset->removeCard($card);
        $this->assetRepository->save($asset);
    }

    public function getCards(string $language, User $user, int $asset): array
    {
        $language = $this->getLanguage($language);
        $asset = $this->getAsset($asset);

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
            'result' => $result ? $result->getValue() : null,
            'level' => $asset->getLevel(),
        ];
    }

    /**
     * @param  int  $card
     *
     * @return Collection|Example[]|array
     */
    public function getExamples(int $card): array
    {
        return $card->getExamples();
    }

    public function addExample(int $card, string $text, string $value): Example
    {
        $card = $this->getCard($card);

        $example = new Example($text, $value, $card);

        $this->exampleRepository->save($example);

        return $example;
    }

    public function deleteExamplesOfCard(int $card)
    {
        $card = $this->getCard($card);

        foreach ($card->getExamples() as $example) {
            $this->exampleRepository->delete($example);
        }
    }

    public function editTranslate(int $translate, string $text): Translate
    {
        /** @var Translate $translate */
        $translate = $this->translateRepository->find($translate);

        $translate->setValue($text);
        $this->translateRepository->save($translate);

        return $translate;
    }

    public function fillDictionary(string $language, int $word)
    {
        $language = $this->getLanguage($language);

        /** @var Word $word */
        $word = $this->wordRepository->find($word);

        $results = $this->translater->translate($language, $word);

        foreach ($results['translations'] as $result) {
            $translate = new Translate();
            $translate->setValue($result['text']);
            $translate->setSentence(0);
            $translate->setLanguage($language);

            $word->addTranslate($translate);

            $card = new Card();
            $card->setType(0);
            $card->setWord($word);
            $card->setTranslate($translate);
            $card->setLanguage($language);

            $this->cardRepository->save($card);
        }
    }
    
    public function uploadCsvSentences(string $language, UploadedFile $file)
    {
        $language = $this->getLanguage($language);

        $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();

        Storage::disk('sentences')->put($filename, file_get_contents($file));

        $path = Storage::disk('sentences')->path($filename);

        if (!file_exists($path)) {
            throw new \Exception('File not exist', 500);
        }

        $handle = fopen($path, "r");
        if (!$handle) {
            throw new \Exception('Cant open file', 500);
        }


        while(!feof($handle))
        {
            $data = fgetcsv($handle, 0, ';');
            $orig = $data[0];
            $translateValue = $data[1];

            $isWordExist = $this->wordRepository->findOneBy([
                'word' => $orig
            ]);

            if ($isWordExist) {
                continue;
            }

            $word = new Word();
            $word->setSentence(1);
            $word->setValue($orig);
            $word->setIsPublic(1);

            $translate = new Translate();
            $translate->setValue($translateValue);
            $translate->setSentence(1);
            $translate->setLanguage($language);
            $translate->setWord($word);

            $card = new Card();
            $card->setLanguage($language);
            $card->setWord($word);
            $card->setTranslate($translate);
            $card->setType(1);

            $this->cardRepository->save($card);
        }

        fclose($handle);
    }
}