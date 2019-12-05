<?php


namespace App\Repositories\Asset;


use App\Entities\Asset;
use App\Entities\Language;
use App\Repositories\BaseRepositoryInterface;

interface AssetRepositoryInterface extends BaseRepositoryInterface
{
    public function getFirstAsset(Language $language, int $type) : Asset;
}