<?php


namespace Scandinaver\Learn\Domain\Model;


class FavouriteAsset extends Asset
{
    public function getType(): string
    {
        return Asset::TYPE_FAVORITES;
    }

    protected int $category = 3;
}