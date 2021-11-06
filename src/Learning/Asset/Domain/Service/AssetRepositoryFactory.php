<?php


namespace Scandinaver\Learning\Asset\Domain\Service;

use Illuminate\Contracts\Container\BindingResolutionException;
use Scandinaver\Learning\Asset\Domain\Entity\Asset;
use Scandinaver\Learning\Asset\Infrastructure\Persistence\Doctrine\Repository\AssetRepository;

/**
 * Class AssetRepositoryFactory
 *
 * @package Scandinaver\Learn\Domain\Services
 */
class AssetRepositoryFactory
{
    /**
     * @param  int  $type
     *
     * @return AssetRepository
     * @throws BindingResolutionException
     */
    public static function getByType(int $type): AssetRepository
    {
        switch ($type) {
            case Asset::TYPE_PERSONAL:
                return app()->make('Scandinaver\Learning\Asset\Domain\Contract\Repository\PersonalAssetRepositoryInterface');
            case Asset::TYPE_WORDS:
                return app()->make('Scandinaver\Learning\Asset\Domain\Contract\Repository\WordAssetRepositoryInterface');
            case Asset::TYPE_SENTENCES:
                return app()->make('Scandinaver\Learning\Asset\Domain\Contract\Repository\SentenceAssetRepositoryInterface');
            case Asset::TYPE_FAVORITES:
                return app()->make('Scandinaver\Learning\Asset\Domain\Contract\Repository\FavouriteAssetRepositoryInterface');
        }
    }
}