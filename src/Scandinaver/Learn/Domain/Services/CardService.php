<?php


namespace Scandinaver\Learn\Domain\Services;

use Doctrine\Common\Collections\Collection;
use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Scandinaver\Common\Domain\Services\LanguageTrait;
use Scandinaver\Learn\Domain\Contract\Repository\AssetRepositoryInterface;
use Scandinaver\Learn\Domain\Contract\Repository\CardRepositoryInterface;
use Scandinaver\Learn\Domain\Contract\Repository\ExampleRepositoryInterface;
use Scandinaver\Learn\Domain\Contract\Repository\FavouriteAssetRepositoryInterface;
use Scandinaver\Learn\Domain\Contract\Repository\PassingRepositoryInterface;
use Scandinaver\Learn\Domain\Contract\Repository\TranslateRepositoryInterface;
use Scandinaver\Learn\Domain\Contract\Repository\WordRepositoryInterface;
use Scandinaver\Learn\Domain\Contract\Service\SearchInterface;
use Scandinaver\Learn\Domain\Contract\Service\TranslaterInterface;
use Scandinaver\Learn\Domain\Exceptions\AssetNotFoundException;
use Scandinaver\Learn\Domain\Exceptions\CardNotFoundException;
use Scandinaver\Learn\Domain\Exceptions\LanguageNotFoundException;
use Scandinaver\Learn\Domain\Model\{AssetDTO, Card, Example, Translate, Word};
use Scandinaver\Shared\Contract\BaseServiceInterface;
use Scandinaver\Shared\DTO;
use Scandinaver\User\Domain\Model\User;
use Storage;

/**
 * Class CardService
 *
 * @package Scandinaver\Learn\Domain\Services
 */
class CardService implements BaseServiceInterface
{
    use LanguageTrait;
    use AssetTrait;
    use CardTrait;

    private AssetRepositoryInterface $assetRepository;

    private CardRepositoryInterface $cardRepository;

    private PassingRepositoryInterface $passingRepository;

    private TranslateRepositoryInterface $translateRepository;

    private ExampleRepositoryInterface $exampleRepository;

    private CardFactory $cardFactory;

    private FavouriteAssetRepositoryInterface $favouriteAssetRepository;

    private WordRepositoryInterface $wordRepository;

    private TranslaterInterface $translater;

    private SearchInterface $searchService;

    public function __construct(
        AssetRepositoryInterface $assetRepository,
        CardRepositoryInterface $cardRepository,
        PassingRepositoryInterface $passingRepository,
        ExampleRepositoryInterface $exampleRepository,
        TranslateRepositoryInterface $translateRepository,
        FavouriteAssetRepositoryInterface $favouriteAssetRepository,
        WordRepositoryInterface $wordRepository,
        CardFactory $cardFactory,
        TranslaterInterface $translater,
        SearchInterface $searchService
    ) {
        $this->assetRepository          = $assetRepository;
        $this->cardRepository           = $cardRepository;
        $this->passingRepository         = $passingRepository;
        $this->exampleRepository        = $exampleRepository;
        $this->translateRepository      = $translateRepository;
        $this->cardFactory              = $cardFactory;
        $this->favouriteAssetRepository = $favouriteAssetRepository;
        $this->wordRepository           = $wordRepository;
        $this->translater               = $translater;
        $this->searchService = $searchService;
    }

    /**
     * @param  User    $user
     * @param  string  $language
     * @param  string  $word
     * @param  string  $translate
     *
     * @return Card
     */
    public function createCard(User $user, string $language, string $word, string $translate): Card
    {
        $data = [
            'word'      => $word,
            'translate' => $translate,
            'creator'   => $user,
            'language'  => $language,
        ];

        $card = $this->cardFactory->build($data);

        $this->cardRepository->save($card);

        return $card;
    }

    /**
     * @param  int    $card
     * @param  array  $data
     *
     * @return Card
     * @throws CardNotFoundException
     */
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
                if ($example === NULL) {
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

    /**
     * @param  User  $user
     * @param  int   $asset
     *
     * @return array
     * @throws AssetNotFoundException
     */
    public function getCards(User $user, int $asset): array
    {
        $asset    = $this->getAsset($asset);
        $language = $asset->getLanguage();

        $favouriteAsset = $user->getFavouriteAsset($language);

        $passing = $this->passingRepository->getPassing($user, $asset);

        $cards = $asset->getCards();

        $cardsDTO = [];

        foreach ($cards as &$card) {
            $card->setFavourite(
                in_array($card->getWord()->getId(), $favouriteAsset->getWordsIds())
            );
            $cardsDTO[] = $card->toDTO();
        }

        return [
            'id'     => $asset->getId(),
            'type'   => $asset->getType(),
            'cards'  => $cardsDTO,
            'title'  => $asset->getTitle(),
            'result' => $passing ? $passing->getPercent() : NULL,
            'level'  => $asset->getLevel(),
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

    /**
     * @param  int     $card
     * @param  string  $text
     * @param  string  $value
     *
     * @return Example
     * @throws CardNotFoundException
     */
    public function addExample(int $card, string $text, string $value): Example
    {
        $card = $this->getCard($card);

        $example = new Example($text, $value, $card);

        $this->exampleRepository->save($example);

        return $example;
    }

    /**
     * @param  int  $card
     *
     * @throws CardNotFoundException
     */
    public function deleteExamplesOfCard(int $card)
    {
        $card = $this->getCard($card);

        foreach ($card->getExamples() as $example) {
            $this->exampleRepository->delete($example);
        }
    }

    /**
     * @param  int     $translate
     * @param  string  $text
     *
     * @return Translate
     */
    public function editTranslate(int $translate, string $text): Translate
    {
        /** @var Translate $translate */
        $translate = $this->translateRepository->find($translate);

        $translate->setValue($text);
        $this->translateRepository->save($translate);

        return $translate;
    }

    /**
     * @param  string  $language
     * @param  int     $word
     *
     * @throws LanguageNotFoundException
     */
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

    /**
     * @param  string        $language
     * @param  UploadedFile  $file
     *
     * @throws LanguageNotFoundException
     * @throws Exception
     */
    public function uploadCsvSentences(string $language, UploadedFile $file)
    {
        $language = $this->getLanguage($language);

        $filename = Str::random(40).'.'.$file->getClientOriginalExtension();

        Storage::disk('sentences')->put($filename, file_get_contents($file));

        $path = Storage::disk('sentences')->path($filename);

        if (!file_exists($path)) {
            throw new Exception('File not exist', 500);
        }

        $handle = fopen($path, "r");
        if (!$handle) {
            throw new Exception('Cant open file', 500);
        }


        while (!feof($handle)) {
            $data           = fgetcsv($handle, 0, ';');
            $orig           = $data[0];
            $translateValue = $data[1];

            $isWordExist = $this->wordRepository->findOneBy(
                [
                    'word' => $orig,
                ]
            );

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

    public function all(): array
    {
        // TODO: Implement all() method.
    }

    /**
     * @param  int  $id
     *
     * @return DTO
     * @throws CardNotFoundException
     */
    public function one(int $id): DTO
    {
        return $this->getCard($id)->toDTO();
    }

    /**
     * @param  string  $language
     * @param  string  $query
     * @param  bool    $isSentence
     *
     * @return array|Card[]
     * @throws LanguageNotFoundException
     */
    public function search(string $language, string $query, bool $isSentence): array
    {
        $language = $this->getLanguage($language);

        $cards = $this->searchService->search($language, $query, $isSentence);

        return array_map(fn($card) => $card->toDTO(), $cards);
    }

}