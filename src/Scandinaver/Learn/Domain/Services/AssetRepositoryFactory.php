<?php


namespace Scandinaver\Learn\Domain\Services;

use EntityManager;
use Scandinaver\Learn\Domain\Model\Asset;
use Scandinaver\Learn\Domain\Model\FavouriteAsset;
use Scandinaver\Learn\Domain\Model\PersonalAsset;
use Scandinaver\Learn\Domain\Model\SentenceAsset;
use Scandinaver\Learn\Domain\Model\WordAsset;
use Scandinaver\Learn\Infrastructure\Persistence\Doctrine\AssetRepository;

/**
 * Class AssetRepositoryFactory
 *
 * @package Scandinaver\Learn\Domain\Services
 */
class AssetRepositoryFactory
{
    public static function getByType(int $type): AssetRepository
    {
        switch ($type) {
            case Asset::TYPE_PERSONAL:
                return app()->make('Scandinaver\Learn\Domain\Contract\Repository\PersonalAssetRepositoryInterface');
            case Asset::TYPE_WORDS:
                return app()->make('Scandinaver\Learn\Domain\Contract\Repository\WordAssetRepositoryInterface');
            case Asset::TYPE_SENTENCES:
                return app()->make('Scandinaver\Learn\Domain\Contract\Repository\SentenceAssetRepositoryInterface');
            case Asset::TYPE_FAVORITES:
                return app()->make('Scandinaver\Learn\Domain\Contract\Repository\FavouriteAssetRepositoryInterface');
        }
    }
}