<?php


namespace Scandinaver\Translate\Domain\Service;

use Doctrine\Common\Collections\ArrayCollection;
use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use PDO;
use Scandinaver\Common\Domain\Contract\UserInterface;
use Scandinaver\Common\Domain\Entity\Language;
use Scandinaver\Common\Domain\Service\LanguageTrait;
use Scandinaver\Learn\Domain\Exception\LanguageNotFoundException;
use Scandinaver\Translate\Domain\Contract\Repository\ResultRepositoryInterface;
use Scandinaver\Translate\Domain\Contract\Repository\SynonymRepositoryInterface;
use Scandinaver\Translate\Domain\Contract\Repository\TextExtraRepositoryInterface;
use Scandinaver\Translate\Domain\Contract\Repository\TextRepositoryInterface;
use Scandinaver\Translate\Domain\Contract\Repository\WordRepositoryInterface;
use Scandinaver\Translate\Domain\DTO\ExtraDTO;
use Scandinaver\Translate\Domain\DTO\SynonymDTO;
use Scandinaver\Translate\Domain\DTO\TextDTO;
use Scandinaver\Translate\Domain\DTO\WordDTO;
use Scandinaver\Translate\Domain\Entity\Sentence;
use Scandinaver\Translate\Domain\Entity\Word;
use Scandinaver\Translate\Domain\Exception\TextNotFoundException;
use Scandinaver\Translate\Domain\Entity\Result;
use Scandinaver\Translate\Domain\Entity\Synonym;
use Scandinaver\Translate\Domain\Entity\Text;
use Scandinaver\Translate\Domain\Entity\TextExtra;

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

    private TextExtraRepositoryInterface $textExtraRepository;

    private SynonymFactory $synonymFactory;

    private WordRepositoryInterface $wordRepository;

    public function __construct(
        TextRepositoryInterface $textRepository,
        ResultRepositoryInterface $resultRepository,
        SynonymRepositoryInterface $synonymRepository,
        TextExtraRepositoryInterface $textExtraRepository,
        WordRepositoryInterface $wordRepository,
        SynonymFactory $synonymFactory
    ) {
        $this->textRepository    = $textRepository;
        $this->resultRepository  = $resultRepository;
        $this->synonymRepository = $synonymRepository;
        $this->synonymFactory    = $synonymFactory;
        $this->textExtraRepository = $textExtraRepository;
        $this->wordRepository = $wordRepository;
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
     * @return array|Text[]
     * @throws LanguageNotFoundException
     */
    public function getAllByLanguage(string $language): array
    {
        $language = $this->getLanguage($language);

        /** @var Text $texts */
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

        $activeArray = $this->textRepository->getActiveIds($user, $language);

        /** @var Text[] $texts */
        $texts = $this->textRepository->getByLanguage($language);

        $counter = 0;

        foreach ($texts as &$text) {

            $counter++;

            $text->setActive(in_array($text->getId(), $activeArray));

            $text->setAvailable($counter < 3 || $user->isActive());
        }

        return $texts;
    }

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
     * @throws TextNotFoundException
     */
    public function updateText(int $id, TextDTO $textDTO): Text
    {
        $text = $this->getText($id);

        $text = $this->updateExtras($text, $textDTO->getExtraDTO());

        $text = $this->updateSentences($text, $textDTO->getSentences());

        $text->setPublished($textDTO->isPublished());

        $text->setDescription($textDTO->getDescription());

        $this->textRepository->save($text);

        return $text;
    }

    /**
     * @param  Text   $text
     * @param  ExtraDTO[]  $data
     *
     * @return Text
     */
    private function updateExtras(Text $text, array $data): Text
    {
        foreach ($data as $extraDTO) {
            // add
            if ($extraDTO->getId() === NULL) {
                $extra = ExtraFactory::fromDTO($extraDTO);
                $extra->setText($text);
                $text->addExtra($extra);
            }

            //update
            if ($extraDTO->getId() !== NULL) {
                /** @var TextExtra $extra */
                $extra = $text->getExtra()->filter(fn($item) => $item->getId() === $extraDTO->getId())->first();
                $extra->setObject($extraDTO->getObject());
                $extra->setValue($extraDTO->getValue());
                $this->textExtraRepository->save($extra);
            }
        }

        // delete
        $newExtraCollection = new ArrayCollection($data);
        foreach ($text->getExtra() as $extra) {
            // new entity, continue
            if ($extra->getId() === NULL) {
                continue;
            }
            $isExist = $newExtraCollection->exists(function($key, $val) use ($extra) {
                return $val->getId() === $extra->getId();
            });
            if ($isExist === FALSE) {
                $text->getExtra()->removeElement($extra);
            }
        }

        return $text;
    }

    /**
     * @param  Text   $text
     * @param  Sentence[]  $data
     *
     * @return Text
     */
    private function updateSentences(Text $text, array $data): Text
    {
        $newWordsCollection = new ArrayCollection();

        foreach ($data as $sentence) {
            $sentenceNum = $sentence->getId();
            /** @var WordDTO[] $words */
            $words = $sentence->getWords();
            foreach ($words as $wordDTO) {
                $newWordsCollection->add($wordDTO);
                if ($wordDTO->getId() === NULL) {
                    $word = new Word();
                    $word->setSentenceNum($sentenceNum);
                    $word->setWord($wordDTO->getObject());
                    $word->setOrig($wordDTO->getValue());
                    $word->setText($text);
                    $text->addWord($word);
                }

                if ($wordDTO->getId() !== NULL) {
                    /** @var Word $word */
                    $word = $text->getWords()->filter(fn($item) => $item->getId() === $wordDTO->getId())->first();
                    $word->setWord($wordDTO->getObject());
                    $word->setOrig($wordDTO->getValue());
                    $this->wordRepository->save($word);
                }
            }
        }

        foreach ($text->getWords() as $word) {
            // new entity, continue
            if ($word->getId() === NULL) {
                continue;
            }
            $isExist = $newWordsCollection->exists(function($key, $val) use ($word) {
                return $val->getId() === $word->getId();
            });
            if ($isExist === FALSE) {
                $text->getWords()->removeElement($word);
            }
        }

        return $text;
    }

    private function getMaxLevel(Language $language): int
    {
        /** @var Text $text */
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
     * @throws TextNotFoundException|\Doctrine\DBAL\Driver\Exception
     */
    public function prepareText(int $textId): Text
    {
        $text = $this->getText($textId);

        $sql = 'select 
                              w.word as word,  w.orig
                                  from word_in_text as w
                                    where text_id = ? and w.orig != ""
                              union 
                                  select s.synonym as word,  w.orig
                                    from word_in_text as w
                                      left join synonym as s
                                        on s.word_id = w.id
                                      where text_id = ?
                                    ';


        $params = [$text->getId(), $text->getId()];

        $stmt = app('em')->getConnection()->prepare($sql);
        $stmt->execute($params);
        $words = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $data = [];

        foreach ($words as $word) {
            if ($word['word'] !== NULL && $word['orig'] !== NULL) {
                $data[mb_strtolower($word['orig'])][] = trim($word['word']);
            }
        }

        $text->setDictionary($data);

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

        $nextText = $this->textRepository->getNextText($text);

        $result = $this->resultRepository->findOneBy(
            ['user' => $user, 'text' => $text]
        );

        if ($result === NULL) {
            $result = new Result($nextText, $user, $text->getLanguage());
        }

        $result = $this->resultRepository->save($result);

        return $nextText;
    }

    public function removePassingsByUser(UserInterface $user): void
    {
        /** @var Result[] $passings */
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

        $text->getExtra()->clear();
        $text->getWords()->clear();

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