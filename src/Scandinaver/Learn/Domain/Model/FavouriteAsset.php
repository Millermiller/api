<?php


namespace Scandinaver\Learn\Domain\Model;

use Scandinaver\Common\Domain\Model\Language;

/**
 * Class FavouriteAsset
 *
 * @package Scandinaver\Learn\Domain\Model
 */
class FavouriteAsset extends Asset
{
    protected int $category = Asset::TYPE_FAVORITES;

    public function __construct(Language $language)
    {
        parent::__construct('Избранное', FALSE, TRUE, $language);
    }

    public function getType(): int
    {
        return Asset::TYPE_FAVORITES;
    }

}