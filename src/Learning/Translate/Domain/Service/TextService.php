<?php


namespace Scandinaver\Learning\Translate\Domain\Service;

use Doctrine\Common\Collections\ArrayCollection;
use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Scandinaver\Common\Domain\Contract\UserInterface;
use Scandinaver\Common\Domain\Entity\Language;
use Scandinaver\Common\Domain\Service\LanguageTrait;
use Scandinaver\Learning\Asset\Domain\Exception\LanguageNotFoundException;
use Scandinaver\Learning\Translate\Domain\Contract\Repository\ResultRepositoryInterface;
use Scandinaver\Learning\Translate\Domain\Contract\Repository\SynonymRepositoryInterface;
use Scandinaver\Learning\Translate\Domain\Contract\Repository\TextRepositoryInterface;
use Scandinaver\Learning\Translate\Domain\Contract\Repository\TooltipRepositoryInterface;
use Scandinaver\Learning\Translate\Domain\Contract\Repository\WordRepositoryInterface;
use Scandinaver\Learning\Translate\Domain\DTO\DictionaryItemDTO;
use Scandinaver\Learning\Translate\Domain\DTO\SynonymDTO;
use Scandinaver\Learning\Translate\Domain\DTO\TextDTO;
use Scandinaver\Learning\Translate\Domain\DTO\TooltipDTO;
use Scandinaver\Learning\Translate\Domain\Entity\DictionaryItem;
use Scandinaver\Learning\Translate\Domain\Entity\Passing;
use Scandinaver\Learning\Translate\Domain\Entity\Synonym;
use Scandinaver\Learning\Translate\Domain\Entity\Text;
use Scandinaver\Learning\Translate\Domain\Entity\Tooltip;
use Scandinaver\Learning\Translate\Domain\Exception\SynonymAlreadyExistsException;
use Scandinaver\Learning\Translate\Domain\Exception\TextNotFoundException;

/**
 * Class TextService
 *
 * @package Scandinaver\Translate\Domain;
 */
class TextService
{

    use LanguageTrait, TextTrait;

    protected ResultRepositoryInterface $resultRepository;

    private TextRepositoryInterface $textRepository;

    private SynonymRepositoryInterface $synonymRepository;

    private TooltipRepositoryInterface $tooltipRepository;

    private SynonymFactory $synonymFactory;

    private WordRepositoryInterface $wordRepository;

    public function __construct(
        TextRepositoryInterface $textRepository,
        ResultRepositoryInterface $resultRepository,
        SynonymRepositoryInterface $synonymRepository,
        TooltipRepositoryInterface $tooltipRepository,
        WordRepositoryInterface $wordRepository,
        SynonymFactory $synonymFactory
    ) {
        $this->textRepository    = $textRepository;
        $this->resultRepository  = $resultRepository;
        $this->synonymRepository = $synonymRepository;
        $this->synonymFactory    = $synonymFactory;
        $this->tooltipRepository = $tooltipRepository;
        $this->wordRepository    = $wordRepository;
    }

    public function count(): int
    {
        return $this->textRepository->count([]);
    }

    /**
     * @param  string  $language
     *
     * @return int
     * @throws LanguageNotFoundException
     */
    public function countByLanguage(string $language): int
    {
        $language = $this->getLanguage($language);

        return $this->textRepository->getCountByLanguage($language);
    }

    /**
     * @param  string  $language
     *
     * @return Text[]
     * @throws LanguageNotFoundException
     */
    public function getAllByLanguage(string $language): array
    {
        $language = $this->getLanguage($language);

        return $this->textRepository->findBy(['language' => $language]);
    }

    /**
     * @param  string         $language
     * @param  UserInterface  $user
     *
     * @return array|TextDTO[]
     * @throws LanguageNotFoundException
     */
    public function getTextsForUser(string $language, UserInterface $user): array
    {
        $language = $this->getLanguage($language);

        $texts = $this->textRepository->getByLanguage($language);

        $isNextAvailable = FALSE;

        foreach ($texts as $text) {
            $result = $text->getBestResultForUser($user);
            $text->setBestResult($result);

            if ($text->isFirst() || $isNextAvailable) {
                $text->setActive(TRUE);
            }

            $text->setCompleted($text->isCompletedByUser($user));
            $isNextAvailable = $text->isCompletedByUser($user);

            if ($text->getLevel() <= 5 || $user->isRaising()) { // TODO: implement settings
                $text->setAvailable(TRUE);
            }
        }

        return $texts;
    }

    /**
     * @param  TextDTO  $textDTO
     *
     * @return Text
     * @throws LanguageNotFoundException
     */
    public function createText(TextDTO $textDTO): Text
    {
        $language = $this->getLanguage($textDTO->getLanguageLetter());

        $text = TextFactory::fromDTO($textDTO);

        $level = $this->getMaxLevel($language);

        $text->setLanguage($language);
        $text->setLevel($level);
        $text->setPublished(FALSE);

        $this->textRepository->save($text);

        return $text;
    }

    /**
     * @param  int      $id
     * @param  TextDTO  $textDTO
     *
     * @return Text
     * @throws TextNotFoundException|SynonymAlreadyExistsException
     */
    public function updateText(int $id, TextDTO $textDTO): Text
    {
        $text = $this->getText($id);

        $text = $this->updateTooltips($text, $textDTO->getTooltipDTO());

        $text = $this->updateDictionary($text, $textDTO->getDictionary());

        $text->setPublished($textDTO->isPublished());

        $text->setDescription($textDTO->getDescription());

        $this->textRepository->save($text);

        return $text;
    }

    /**
     * @param  Text   $text
     * @param  TooltipDTO[]  $data
     *
     * @return Text
     */
    private function updateTooltips(Text $text, array $data): Text
    {
        foreach ($data as $tooltipDTO) {
            // add
            if ($tooltipDTO->getId() === NULL) {
                $tooltip = TooltipFactory::fromDTO($tooltipDTO);
                $tooltip->setText($text);
                $text->addTooltip($tooltip);
            }

            //update
            if ($tooltipDTO->getId() !== NULL) {
                /** @var Tooltip $tooltip */
                $tooltip = $text->getTooltips()->filter(fn($item) => $item->getId() === $tooltipDTO->getId())->first();
                $tooltip->setObject($tooltipDTO->getObject());
                $tooltip->setValue($tooltipDTO->getValue());
                $this->tooltipRepository->save($tooltip);
            }
        }

        // delete
        $newTooltipCollection = new ArrayCollection($data);
        foreach ($text->getTooltips() as $tooltip) {
            // new entity, continue
            if ($tooltip->getId() === NULL) {
                continue;
            }
            $isExist = $newTooltipCollection->exists(function($key, $val) use ($tooltip) {
                return $val->getId() === $tooltip->getId();
            });
            if ($isExist === FALSE) {
                $text->getTooltips()->removeElement($tooltip);
            }
        }

        return $text;
    }

    /**
     * @param  Text                 $text
     * @param  DictionaryItemDTO[]  $data
     *
     * @return Text
     * @throws SynonymAlreadyExistsException
     */
    private function updateDictionary(Text $text, array $data): Text
    {
        foreach ($data as $dictionaryItemDTO) {
            // add
            if ($dictionaryItemDTO->getId() === NULL) {
                $dictionaryItem = DictionaryItemFactory::fromDTO($dictionaryItemDTO);
                $dictionaryItem->setText($text);
                $text->addDictionaryItem($dictionaryItem);
            }

            //update
            if ($dictionaryItemDTO->getId() !== NULL) {
                /** @var DictionaryItem $dictionaryItem */
                $dictionaryItem = $text->getDictionary()->filter(fn($item) => $item->getId() === $dictionaryItemDTO->getId())->first();
                $dictionaryItem->setObject($dictionaryItemDTO->getText());
                $dictionaryItem->setValue($dictionaryItemDTO->getValue());
                $dictionaryItem->setCoordinates($dictionaryItemDTO->getCoordinates());

                $dictionaryItem = $this->updateSynonyms($dictionaryItem, $dictionaryItemDTO->getSynonyms());

                $this->wordRepository->save($dictionaryItem);
            }
        }

        // delete
        $newDictionaryItemCollection = new ArrayCollection($data);
        foreach ($text->getDictionary() as $dictionaryItem) {
            // new entity, continue
            if ($dictionaryItem->getId() === NULL) {
                continue;
            }
            $isExist = $newDictionaryItemCollection->exists(function($key, $val) use ($dictionaryItem) {
                return $val->getId() === $dictionaryItem->getId();
            });
            if ($isExist === FALSE) {
                $text->getDictionary()->removeElement($dictionaryItem);
            }
        }

        return $text;
    }

    /**
     * @param  DictionaryItem  $dictionaryItem
     * @param  array           $data
     *
     * @return DictionaryItem
     * @throws SynonymAlreadyExistsException
     */
    public function updateSynonyms(DictionaryItem $dictionaryItem, array $data): DictionaryItem
    {
        foreach ($data as $synonymDTO) {
            // add
            if ($synonymDTO->getId() === NULL) {
                $synonym = new Synonym($dictionaryItem, $synonymDTO->getValue());
                $dictionaryItem->addSynonym($synonym);
            }

            //update
            if ($synonymDTO->getId() !== NULL) {
                /** @var Synonym $synonym */
                $synonym = $dictionaryItem->getSynonyms()->filter(fn($item) => $item->getId() === $synonymDTO->getId())->first();
                $synonym->setValue($synonymDTO->getValue());

                $this->synonymRepository->save($synonym);
            }
        }

        // delete
        $newSynonymCollection = new ArrayCollection($data);
        foreach ($dictionaryItem->getSynonyms() as $synonym) {
            // new entity, continue
            if ($synonym->getId() === NULL) {
                continue;
            }
            $isExist = $newSynonymCollection->exists(function($key, $val) use ($synonym) {
                return $val->getId() === $synonym->getId();
            });
            if ($isExist === FALSE) {
                $dictionaryItem->getSynonyms()->removeElement($synonym);
            }
        }

        return $dictionaryItem;
    }

    private function getMaxLevel(Language $language): int
    {
        $texts = $this->textRepository->findBy([
            'language' => $language,
        ],
            ['level' => 'DESC'],
            1);

        if ($texts === []) {
            return 1;
        }

        $text = reset($texts);

        return $text->getLevel();
    }

    /**
     * @param  int  $textId
     *
     * @return Text
     * @throws Exception
     * @throws TextNotFoundException|Exception
     */
    public function prepareText(int $textId): Text
    {
        $text = $this->getText($textId);


        return $text;
    }

    /**
     * @param  UserInterface  $user
     * @param  int            $textId
     *
     * @return Text
     * @throws TextNotFoundException
     */
    public function giveNextLevel(UserInterface $user, int $textId): Text
    {
        $text = $this->getText($textId);

        $nextText = $this->textRepository->getNextLevel($text);

        $result = $this->resultRepository->findOneBy(
            ['user' => $user, 'text' => $text]
        );

        if ($result === NULL) {
            $result = new Passing($text, $user, TRUE, []);
        }

        $result = $this->resultRepository->save($result);

        return $nextText;
    }

    public function removePassingsByUser(UserInterface $user): void
    {
        $passings = $this->resultRepository->findBy([
            'user' => $user,
        ]);

        foreach ($passings as $passing) {
            $this->resultRepository->delete($passing);
        }
    }

    /**
     * @param  int  $id
     *
     * @throws TextNotFoundException
     */
    public function deleteText(int $id): void
    {
        $text = $this->getText($id);

        $text->getTooltips()->clear();
        $text->getTranslates()->clear();

        $this->textRepository->delete($text);
    }

    public function getSynonymsByWordId(int $id): array
    {
        return $this->synonymRepository->findBy([
            'word' => $id,
        ]);
    }

    /**
     * @param  SynonymDTO  $synonymDTO
     *
     * @return Synonym
     * @throws Exception
     */
    public function createSynonym(SynonymDTO $synonymDTO): Synonym
    {
        $synonym = $this->synonymFactory->fromDTO($synonymDTO);

        $this->synonymRepository->save($synonym);

        return $synonym;
    }

    /**
     * @param  int  $id
     *
     * @throws Exception
     */
    public function deleteSynonym(int $id): void
    {
        $synonym = $this->synonymRepository->find($id);
        if ($synonym === NULL) {
            throw new Exception("Synonym id: $id not found");
        }

        $this->synonymRepository->delete($synonym);
    }

    /**
     * @param  int           $id
     * @param  UploadedFile  $photo
     *
     * @return string
     * @throws TextNotFoundException
     */
    public function saveImage(int $id, UploadedFile $photo): string
    {
        $text = $this->getText($id);

        $filename = Str::random(40) . '.' . $photo->extension();

        $photo->move(public_path('/uploads/t/'), $filename);

        $text->setImage($filename);

        $this->textRepository->save($text);

        return asset('/uploads/t/') . $filename;
    }
}