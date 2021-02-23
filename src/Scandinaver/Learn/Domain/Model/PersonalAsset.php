<?php


namespace Scandinaver\Learn\Domain\Model;


/**
 * Class PersonalAsset
 *
 * @package Scandinaver\Learn\Domain\Model
 */
class PersonalAsset extends Asset
{
    public function getType(): int
    {
        return Asset::TYPE_PERSONAL;
    }

    protected int $category = Asset::TYPE_PERSONAL;
}