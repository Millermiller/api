<?php


namespace Scandinaver\Learn\Domain\Contracts;

use Scandinaver\Learn\Domain\{Asset};
use Scandinaver\Common\Domain\Language;
use Scandinaver\Shared\Contracts\BaseRepositoryInterface;
use Scandinaver\User\Domain\User;

/**
 * Interface AssetRepositoryInterface
 * @package Scandinaver\Learn\Domain\Contracts
 */
interface AssetRepositoryInterface extends BaseRepositoryInterface
{
    public function getFirstAsset(Language $language, int $type): Asset;

    public function getNextAsset(Asset $asset, Language $language): Asset;

    public function getPublicAssets(Language $language): array;

    public function getPersonalAssets(Language $language, User $user): array;

    public function getAssetsByType(Language $language, int $type);

    public function getFavouriteAsset(Language $language, User $user): Asset;

    public function getCreatedAssets(Language $language, User $user): array;
}