<?php


namespace Scandinaver\Common\Domain\Services;

use Scandinaver\Common\Domain\Contract\Repository\LanguageRepositoryInterface;
use Scandinaver\Common\Domain\Model\LanguageDTO;
use Scandinaver\Learn\Domain\Contract\Repository\AssetRepositoryInterface;

/**
 * Class LanguageService
 *
 * @package Scandinaver\Common\Domain\Services
 */
class LanguageService
{
    private LanguageRepositoryInterface $languageRepository;

    private AssetRepositoryInterface $assetRepository;

    public function __construct(
        LanguageRepositoryInterface $languageRepository,
        AssetRepositoryInterface $assetRepository
    ) {
        $this->languageRepository = $languageRepository;
        $this->assetRepository = $assetRepository;
    }

    public function getLanguagesList(): array
    {
        $languages = $this->languageRepository->all();
        $assets = [];
        $response = [];

        foreach ($languages as $language) {
            // $assets[] = $this->assetRepository->getByLanguage($language);

            $dto = new LanguageDTO($language, 0, 0);
            $response[] = $dto;
        }

        return $response;
    }
}