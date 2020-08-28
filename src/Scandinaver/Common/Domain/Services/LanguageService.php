<?php


namespace Scandinaver\Common\Domain\Services;

use Scandinaver\Common\Domain\Contract\Repository\LanguageRepositoryInterface;

/**
 * Class LanguageService
 *
 * @package Scandinaver\Common\Domain\Services
 */
class LanguageService
{
    private LanguageRepositoryInterface $languageRepository;

    public function __construct(LanguageRepositoryInterface $languageRepository)
    {
        $this->languageRepository = $languageRepository;
    }

    public function getLanguagesList(): array
    {
        return $this->languageRepository->all();
    }
}