<?php


namespace Scandinaver\Learn\Domain\Service;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Scandinaver\Common\Domain\Contract\UserInterface;
use Scandinaver\Common\Domain\Service\LanguageTrait;
use Scandinaver\Learn\Domain\Contract\Repository\AssetRepositoryInterface;
use Scandinaver\Learn\Domain\Contract\Repository\CardRepositoryInterface;
use Scandinaver\Learn\Domain\Contract\Repository\ExampleRepositoryInterface;
use Scandinaver\Learn\Domain\Contract\Repository\FavouriteAssetRepositoryInterface;
use Scandinaver\Learn\Domain\Contract\Repository\PassingRepositoryInterface;
use Scandinaver\Learn\Domain\Contract\Repository\TranslateRepositoryInterface;
use Scandinaver\Learn\Domain\Contract\Repository\TermRepositoryInterface;
use Scandinaver\Learn\Domain\Contract\Service\SearchInterface;
use Scandinaver\Learn\Domain\Contract\Service\TranslaterInterface;
use Scandinaver\Learn\Domain\DTO\CardDTO;
use Scandinaver\Learn\Domain\DTO\TranslateDTO;
use Scandinaver\Learn\Domain\DTO\TermDTO;
use Scandinaver\Learn\Domain\Exception\AssetNotFoundException;
use Scandinaver\Learn\Domain\Exception\CardNotFoundException;
use Scandinaver\Learn\Domain\Exception\LanguageNotFoundException;
use Scandinaver\Learn\Domain\Entity\Asset;
use Scandinaver\Learn\Domain\Entity\Card;
use Scandinaver\Learn\Domain\Entity\Example;
use Scandinaver\Learn\Domain\Entity\Translate;
use Scandinaver\Learn\Domain\Entity\Term;
use Scandinaver\Shared\Contract\BaseServiceInterface;
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

    private FavouriteAssetRepositoryInterface $favouriteAssetRepository;

    private TermRepositoryInterface $termRepository;

    private TranslaterInterface $translater;

    private SearchInterface $searchService;

    private AssetFactory $assetFactory;

    public function __construct(
        AssetRepositoryInterface $assetRepository,
        CardRepositoryInterface $cardRepository,
        PassingRepositoryInterface $passingRepository,
        ExampleRepositoryInterface $exampleRepository,
        TranslateRepositoryInterface $translateRepository,
        FavouriteAssetRepositoryInterface $favouriteAssetRepository,
        TermRepositoryInterface $termRepository,
        TranslaterInterface $translater,
        SearchInterface $searchService,
        AssetFactory $assetFactory
    ) {
        $this->assetRepository          = $assetRepository;
        $this->cardRepository           = $cardRepository;
        $this->passingRepository        = $passingRepository;
        $this->exampleRepository        = $exampleRepository;
        $this->translateRepository      = $translateRepository;
        $this->favouriteAssetRepository = $favouriteAssetRepository;
        $this->termRepository           = $termRepository;
        $this->translater               = $translater;
        $this->searchService            = $searchService;
        $this->assetFactory             = $assetFactory;
    }

    public function all(): array
    {
        // TODO: Implement all() method.
    }

    /**
     * @param  int  $id
     *
     * @return Card
     * @throws CardNotFoundException
     */
    public function one(int $id): Card
    {
        return $this->getCard($id);
    }

    /**
     * @param  UserInterface  $user
     * @param  string         $language
     * @param  string         $word
     * @param  string         $translate
     *
     * @return Card
     * @throws LanguageNotFoundException
     */
    public function createCard(UserInterface $user, string $language, string $word, string $translate): Card
    {
        $language = $this->getLanguage($language);

        $cardDTO = new CardDTO();

        $cardDTO->setCreator($user);
        $cardDTO->setLanguage($language);

        $termDTO = new TermDTO(NULL, $word);

        $translateDTO = new TranslateDTO(NULL, $translate);

        $cardDTO->setTermDTO($termDTO);
        $cardDTO->setTranslateDTO($translateDTO);

        $card = CardFactory::fromDTO($cardDTO);

        $this->cardRepository->save($card);

        return $card;
    }

    /**
     * @param  int      $cardId
     * @param  CardDTO  $cardDTO
     *
     * @return Card
     * @throws CardNotFoundException
     */
    public function updateCard(int $cardId, CardDTO $cardDTO): Card
    {
        $card = $this->getCard($cardId);

        $card->setTermValue($cardDTO->getTermDTO()->getValue());

        $card->setTranslateValue($cardDTO->getTranslateDTO()->getValue());

        foreach ($cardDTO->getExamplesDTO() as $exampleDTO) {
            $exampleDTO->setCard($card);

            if ($exampleDTO->getId() === NULL) {
                $example = ExampleFactory::fromDTO($exampleDTO);
                $card->addExample($example);
            }

            if ($exampleDTO->getId() !== NULL) {
                /** @var Example $example */
                $example = $card->getExamples()->filter(fn($item) => $item->getId() === $exampleDTO->getId())->first();
                $example->setText($exampleDTO->getText());
                $example->setValue($exampleDTO->getValue());
                $this->exampleRepository->save($example);
            }
        }

        $newExamplesCollection = new ArrayCollection($cardDTO->getExamplesDTO());

        foreach ($card->getExamples() as $example) {
            if ($example->getId() === NULL) {
                continue;
            }
            $isExist = $newExamplesCollection->exists(function($key, $val) use ($example) {
                return $val->getId() === $example->getId();
            });
            if ($isExist === FALSE) {
                $card->getExamples()->removeElement($example);
            }
        }

        $this->cardRepository->save($card);

        return $card;
    }

    /**
     * @param  UserInterface  $user
     * @param  int            $asset
     *
     * @return Asset
     * @throws AssetNotFoundException
     */
    public function getCards(UserInterface $user, int $asset): Asset
    {
        $asset    = $this->getAsset($asset);

        $language = $asset->getLanguage();

        $favouriteAsset = $user->getFavouriteAsset($language);

        $passing = $asset->getBestResultForUser($user);
        $asset->setBestResult($passing);

        $cards = $asset->getCards();

        foreach ($cards as &$card) {
            $card->setFavourite(
                in_array($card->getTerm()->getId(), $favouriteAsset->getTermsIds())
            );
        }

        return $asset;
    }

    /**
     * @param  int  $id
     *
     * @return Collection|Example[]
     * @throws CardNotFoundException
     */
    public function getExamples(int $id): array
    {
        $card = $this->getCard($id);

        return $card->getExamples()->toArray();
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
     * @param  int     $id
     * @param  string  $text
     *
     * @return Translate
     */
    public function editTranslate(int $id, string $text): Translate
    {
        $translate = $this->translateRepository->find($id);

        $translate->setValue($text);
        $this->translateRepository->save($translate);

        return $translate;
    }

    /**
     * @param  string  $language
     * @param  int     $termId
     *
     * @throws LanguageNotFoundException
     */
    public function fillDictionary(string $language, int $termId): void
    {
        $language = $this->getLanguage($language);

        $term = $this->termRepository->find($termId);

        $results = $this->translater->translate($language, $term);

        foreach ($results['translations'] as $result) {
            $translate = new Translate();
            $translate->setValue($result['text']);
            $translate->setSentence(0);
            $translate->setLanguage($language);

            $term->addTranslate($translate);

            $card = new Card();
            $card->setType(0);
            $card->setTerm($term);
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
    public function uploadCsvSentences(string $language, UploadedFile $file): void
    {
        $language = $this->getLanguage($language);

        $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();

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

            $isTermExist = $this->termRepository->findOneBy(
                [
                    'value' => $orig,
                ]
            );

            if ($isTermExist) {
                continue;
            }

            //TODO: use factory
            $term = new Term();
            $term->setSentence(1);
            $term->setValue($orig);
            $term->setIsPublic(1);

            $translate = new Translate();
            $translate->setValue($translateValue);
            $translate->setSentence(1);
            $translate->setLanguage($language);
            $translate->setTerm($term);

            $card = new Card();
            $card->setLanguage($language);
            $card->setTerm($term);
            $card->setTranslate($translate);
            $card->setType(1);

            $this->cardRepository->save($card);
        }

        fclose($handle);
    }

    /**
     * @param  string       $language
     * @param  string|null  $query
     * @param  bool         $isSentence
     *
     * @return array|Card[]
     * @throws LanguageNotFoundException
     */
    public function search(string $language, ?string $query, bool $isSentence): array
    {
        $language = $this->getLanguage($language);

        return $this->searchService->search($language, $query, $isSentence);
    }

}