<?php


namespace Scandinaver\Learning\Asset\Domain\Service;

use Illuminate\Contracts\Container\BindingResolutionException;
use Scandinaver\Learning\Asset\Domain\Contract\Repository\AssetRepositoryInterface;
use Scandinaver\Learning\Asset\Domain\Enum\AssetType;

/**
 * Class AssetRepositoryFactory
 *
 * @package Scandinaver\Learn\Domain\Services
 */
class AssetRepositoryFactory
{
    /**
     * @param  AssetType  $type
     *
     * @return AssetRepositoryInterface
     * @throws BindingResolutionException
     */
    public static function getByType(AssetType $type): AssetRepositoryInterface
    {
        return match ($type) {
            AssetType::PERSONAL  => app()->make('Scandinaver\Learning\Asset\Domain\Contract\Repository\PersonalAssetRepositoryInterface'),
            AssetType::WORDS     => app()->make('Scandinaver\Learning\Asset\Domain\Contract\Repository\WordAssetRepositoryInterface'),
            AssetType::SENTENCES => app()->make('Scandinaver\Learning\Asset\Domain\Contract\Repository\SentenceAssetRepositoryInterface'),
            AssetType::FAVORITES => app()->make('Scandinaver\Learning\Asset\Domain\Contract\Repository\FavouriteAssetRepositoryInterface'),
        };
    }
}