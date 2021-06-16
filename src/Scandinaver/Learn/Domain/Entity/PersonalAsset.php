<?php


namespace Scandinaver\Learn\Domain\Entity;


/**
 * Class PersonalAsset
 *
 * @package Scandinaver\Learn\Domain\Entity
 */
class PersonalAsset extends Asset
{
    public function getType(): int
    {
        return Asset::TYPE_PERSONAL;
    }

    protected int $category = Asset::TYPE_PERSONAL;
}