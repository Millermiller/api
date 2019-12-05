<?php

namespace App\Repositories\Asset;

use App\Entities\Asset;
use App\Entities\Language;
use App\Entities\User;
use App\Repositories\BaseRepositoryInterface;
use Doctrine\Common\Collections\Collection;

interface AssetRepositoryInterface extends BaseRepositoryInterface
{
    public function getFirstAsset(Language $language, int $type) : Asset;

    public function getPublicAssets(Language $language) : array;

    public function getPersonalAssets(Language $language, User $user) : array;
}