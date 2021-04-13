<?php


namespace Scandinaver\Common\Domain\Services;

use Scandinaver\Common\Domain\Contract\Repository\LanguageRepositoryInterface;
use Scandinaver\Learn\Domain\Contract\Repository\AssetRepositoryInterface;
use Scandinaver\Shared\Contract\BaseServiceInterface;
use Scandinaver\Shared\DTO;

/**
 * Class LanguageService
 *
 * @package Scandinaver\Common\Domain\Services
 */
class LanguageService implements BaseServiceInterface
{
    private LanguageRepositoryInterface $languageRepository;

    private AssetRepositoryInterface $assetRepository;

    public function __construct(
        LanguageRepositoryInterface $languageRepository,
        AssetRepositoryInterface $assetRepository
    ) {
        $this->languageRepository = $languageRepository;
        $this->assetRepository    = $assetRepository;
    }

    public function all(): array
    {
        return $this->languageRepository->findAll();
    }

    public function one(int $id): DTO
    {
        // TODO: Implement one() method.
    }

}