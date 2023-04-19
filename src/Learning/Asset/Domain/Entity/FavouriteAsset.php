<?php


namespace Scandinaver\Learning\Asset\Domain\Entity;

use Scandinaver\Common\Domain\Entity\Language;
use Scandinaver\Learning\Asset\Domain\Enum\AssetType;

/**
 * Class FavouriteAsset
 *
 * @package Scandinaver\Learn\Domain\Entity
 */
class FavouriteAsset extends Asset
{
    public function __construct(Language $language)
    {
        $this->type = AssetType::FAVORITES;

        parent::__construct('Избранное', $language);
    }

    public function getType(): AssetType
    {
        return AssetType::FAVORITES;
    }
}