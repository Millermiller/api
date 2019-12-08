<?php

namespace App\Repositories\Asset;

use App\Entities\{Asset, Language, User};
use App\Repositories\BaseRepositoryInterface;
use Doctrine\Common\Collections\Collection;

interface AssetRepositoryInterface extends BaseRepositoryInterface
{
    public function getFirstAsset(Language $language, int $type) : Asset;

    public function getNextAsset(Asset $asset, Language $language) : Asset;

    public function getPublicAssets(Language $language) : array;

    public function getPersonalAssets(Language $language, User $user) : array;

    public function getAssetsByType(Language $language, int $type);

    public function getFavouriteAsset(Language $language, User $user) : Asset;

    public function getCreatedAssets(Language $language, User $user) : array;
}