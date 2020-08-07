<?php


namespace Scandinaver\Learn\Domain\Contract\Repository;

use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\Learn\Domain\Model\Asset;
use Scandinaver\Shared\Contract\BaseRepositoryInterface;
use Scandinaver\User\Domain\Model\User;

/**
 * Interface AssetRepositoryInterface
 *
 * @package Scandinaver\Learn\Domain\Contract\Repository
 */
interface AssetRepositoryInterface extends BaseRepositoryInterface
{

    /**
     * @param  Language  $language
     * @param  int       $type
     *
     * @return Asset
     */
    public function getFirstAsset(Language $language, int $type): Asset;

    /**
     * @param  Language  $language
     * @param  int       $type
     *
     * @return Asset
     */
    public function getLastAsset(Language $language, int $type): Asset;

    /**
     * @param  Asset     $asset
     * @param  Language  $language
     *
     * @return Asset
     */
    public function getNextAsset(Asset $asset, Language $language): Asset;

    /**
     * @param  Language  $language
     *
     * @return array
     */
    public function getPublicAssets(Language $language): array;

    /**
     * @param  Language  $language
     * @param  User      $user
     *
     * @return array
     */
    public function getPersonalAssets(Language $language, User $user): array;

    /**
     * @param  Language  $language
     * @param  int       $type
     *
     * @return mixed
     */
    public function getAssetsByType(Language $language, int $type): array;

    /**
     * @param  Language  $language
     * @param  User      $user
     *
     * @return Asset
     */
    public function getFavouriteAsset(Language $language, User $user): Asset;

    /**
     * @param  Language  $language
     * @param  User      $user
     *
     * @return array
     */
    public function getCreatedAssets(Language $language, User $user): array;

    /**
     * @param  Language  $language
     *
     * @return int
     */
    public function getCountByLanguage(Language $language): int;
}