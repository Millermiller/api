<?php


namespace Scandinaver\Learn\Domain\Contract\Repository;

use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\Learn\Domain\Model\FavouriteAsset;
use Scandinaver\Shared\Contract\BaseRepositoryInterface;
use Scandinaver\User\Domain\Model\User;

/**
 * Interface FavouriteAssetRepositoryInterface
 *
 * @package Scandinaver\Learn\Domain\Contract\Repository
 */
interface FavouriteAssetRepositoryInterface extends BaseRepositoryInterface
{
    public function getFavouriteAsset(Language $language, User $user): FavouriteAsset;
}