<?php


namespace Scandinaver\Learn\Domain\Service;

use Scandinaver\Common\Domain\Contract\Repository\LanguageRepositoryInterface;
use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\Common\Domain\Service\LanguageTrait;
use Scandinaver\Learn\Domain\Contract\Repository\CardRepositoryInterface;
use Scandinaver\Learn\Domain\Contract\Repository\TranslateRepositoryInterface;
use Scandinaver\Learn\Domain\Contract\Repository\WordRepositoryInterface;
use Scandinaver\Learn\Domain\Exception\LanguageNotFoundException;
use Scandinaver\Learn\Domain\Model\Card;
use Scandinaver\Learn\Domain\Model\Translate;
use Scandinaver\Learn\Domain\Model\Word;
use Scandinaver\Shared\Contract\BaseServiceInterface;

/**
 * Class WordService
 *
 * @package Scandinaver\Learn\Domain\Services
 */
class WordService implements BaseServiceInterface
{
    use LanguageTrait;

    protected LanguageRepositoryInterface $languageRepository;

    private TranslateRepositoryInterface $translateRepository;

    private WordRepositoryInterface $wordsRepository;

    private CardRepositoryInterface $cardRepository;

    public function __construct(
        TranslateRepositoryInterface $translateRepository,
        WordRepositoryInterface $wordsRepository,
        CardRepositoryInterface $cardRepository,
        LanguageRepositoryInterface $languageRepository
    ) {
        $this->translateRepository = $translateRepository;
        $this->wordsRepository     = $wordsRepository;
        $this->languageRepository  = $languageRepository;
        $this->cardRepository      = $cardRepository;
    }

    public function count(): int
    {
        return $this->wordsRepository->count([]);
    }

    public function countByLanguage(string $language): int
    {
        /** @var Language $language */
        $language = $this->languageRepository->find($language);

        return $this->wordsRepository->getCountByLanguage($language);
    }

    /**TODO: проверить
     *
     * @param  string  $language
     * @param  string  $word
     * @param  int     $isSentence
     * @param  string  $translate
     *
     * @return Word
     */
    public function create(
        string $language,
        string $word,
        int $isSentence,
        string $translate
    ): Word {
        $language = $this->languageRepository->find($language);

        $word = new Word();
        $word->setLanguage($language);
        $word->setWord($word);
        $word->setSentence($isSentence);

        $translate = new Translate();
        $translate->setValue($translate);
        $translate->setWord($word);

        $this->wordsRepository->save($word);
        $this->translateRepository->save($translate);
    }

    public function getTranslates(int $word): array
    {
        return $this->translateRepository->searchByIds([$word]);
    }

    public function all(): array
    {
        // TODO: Implement all() method.
    }

    public function one(int $id): Word
    {
        return new Word();
    }

}