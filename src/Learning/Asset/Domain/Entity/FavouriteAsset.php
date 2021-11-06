<?php


namespace Scandinaver\Learning\Asset\Domain\Entity;

use Scandinaver\Common\Domain\Entity\Language;

/**
 * Class FavouriteAsset
 *
 * @package Scandinaver\Learn\Domain\Entity
 */
class FavouriteAsset extends Asset
{
    protected int $category = Asset::TYPE_FAVORITES;

    public function __construct(Language $language)
    {
        parent::__construct('Избранное', $language);
    }

    public function getType(): int
    {
        return Asset::TYPE_FAVORITES;
    }

}