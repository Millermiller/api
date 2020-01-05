<?php

namespace Scandinaver\Learn\Domain\Contracts;

use App\Entities\Language;
use App\Entities\User;
use Scandinaver\Learn\Domain\{Asset};
use App\Repositories\BaseRepositoryInterface;

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