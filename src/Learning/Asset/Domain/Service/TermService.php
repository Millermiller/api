<?php


namespace Scandinaver\Learning\Asset\Domain\Service;

use Scandinaver\Common\Domain\Contract\Repository\LanguageRepositoryInterface;
use Scandinaver\Common\Domain\Entity\Language;
use Scandinaver\Common\Domain\Service\LanguageTrait;
use Scandinaver\Learning\Asset\Domain\Contract\Repository\CardRepositoryInterface;
use Scandinaver\Learning\Asset\Domain\Contract\Repository\TranslateRepositoryInterface;
use Scandinaver\Learning\Asset\Domain\Contract\Repository\TermRepositoryInterface;
use Scandinaver\Learning\Asset\Domain\Entity\Translate;
use Scandinaver\Learning\Asset\Domain\Entity\Term;
use Scandinaver\Shared\Contract\BaseServiceInterface;

/**
 * Class TermService
 *
 * @package Scandinaver\Learn\Domain\Services
 */
class TermService implements BaseServiceInterface
{
    use LanguageTrait;

    protected LanguageRepositoryInterface $languageRepository;

    private TranslateRepositoryInterface $translateRepository;

    private TermRepositoryInterface $termRepository;

    private CardRepositoryInterface $cardRepository;

    public function __construct(
        TranslateRepositoryInterface $translateRepository,
        TermRepositoryInterface $termRepository,
        CardRepositoryInterface $cardRepository,
        LanguageRepositoryInterface $languageRepository
    ) {
        $this->translateRepository = $translateRepository;
        $this->termRepository      = $termRepository;
        $this->languageRepository  = $languageRepository;
        $this->cardRepository      = $cardRepository;
    }

    public function count(): int
    {
        return $this->termRepository->count([]);
    }

    public function countByLanguage(string $lang): int
    {
        $language = $this->languageRepository->find($lang);

        return $this->termRepository->getCountByLanguage($language);
    }

    /**TODO: проверить
     *
     * @param  string  $language
     * @param  string  $value
     * @param  int     $isSentence
     * @param  string  $translate
     *
     * @return Term
     */
    public function create(
        string $language,
        string $value,
        int $isSentence,
        string $translate
    ): Term {
        $language = $this->languageRepository->find($language);

        $term = new Term();
        $term->setValue($value);
        $term->setSentence($isSentence);

        $translate = new Translate();
        $translate->setValue($translate);
        $translate->setTerm($term);

        $this->termRepository->save($term);
        $this->translateRepository->save($translate);
    }

    public function getTranslates(int $id): array
    {
        return $this->translateRepository->searchByIds([$id]);
    }

    public function all(): array
    {
        // TODO: Implement all() method.
    }

    public function one(int $id): Term
    {
        // TODO: Implement one() method.
    }

}