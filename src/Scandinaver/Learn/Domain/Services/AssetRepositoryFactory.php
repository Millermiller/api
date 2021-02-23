<?php


namespace Scandinaver\Learn\Domain\Services;

use Illuminate\Contracts\Container\BindingResolutionException;
use Scandinaver\Learn\Domain\Model\Asset;
use Scandinaver\Shared\BaseRepository;

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
     * @return BaseRepository
     * @throws BindingResolutionException
     */
    public static function getByType(int $type): BaseRepository
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