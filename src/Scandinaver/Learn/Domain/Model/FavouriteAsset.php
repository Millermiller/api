<?php


namespace Scandinaver\Learn\Domain\Model;


use Scandinaver\Common\Domain\Model\Language;

class FavouriteAsset extends Asset
{

    protected int $category = 3;

    public function __construct(Language $language)
    {
        parent::__construct('Избранное', false, true, $language);
    }

    public function getType(): string
    {
        return Asset::TYPE_FAVORITES;
    }

}