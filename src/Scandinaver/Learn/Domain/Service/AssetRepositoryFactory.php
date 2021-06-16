<?php


namespace Scandinaver\Learn\Domain\Service;

use Illuminate\Contracts\Container\BindingResolutionException;
use Scandinaver\Learn\Domain\Entity\Asset;
use Scandinaver\Learn\Infrastructure\Persistence\Doctrine\Repository\AssetRepository;

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