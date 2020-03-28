<?php


namespace Scandinaver\Learn\Domain\Contracts;

use Scandinaver\Common\Domain\Language;
use Scandinaver\Learn\Domain\{Asset};
use Scandinaver\Shared\Contracts\BaseRepositoryInterface;
use Scandinaver\User\Domain\User;

/**
 * Interface AssetRepositoryInterface
 *
 * @package Scandinaver\Learn\Domain\Contracts
 */
interface AssetRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * @param Language $language
     * @param int      $type
     *
     * @return Asset
     */
    public function getFirstAsset(Language $language, int $type): Asset;

    /**
     * @param Language $language
     * @param int      $type
     *
     * @return Asset
     */
    public function getLastAsset(Language $language, int $type): Asset;

    /**
     * @param Asset    $asset
     * @param Language $language
     *
     * @return Asset
     */
    public function getNextAsset(Asset $asset, Language $language): Asset;

    /**
     * @param Language $language
     *
     * @return array
     */
    public function getPublicAssets(Language $language): array;

    /**
     * @param Language $language
     * @param User     $user
     *
     * @return array
     */
    public function getPersonalAssets(Language $language, User $user): array;

    /**
     * @param Language $language
     * @param int      $type
     *
     * @return mixed
     */
    public function getAssetsByType(Language $language, int $type);

    /**
     * @param Language $language
     * @param User     $user
     *
     * @return Asset
     */
    public function getFavouriteAsset(Language $language, User $user): Asset;

    /**
     * @param Language $language
     * @param User     $user
     *
     * @return array
     */
    public function getCreatedAssets(Language $language, User $user): array;

    /**
     * @param Language $language
     *
     * @return int
     */
    public function getCountByLanguage(Language $language): int;
}