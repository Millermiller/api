<?php


namespace Scandinaver\Learn\Domain\Model;


class PersonalAsset extends Asset
{
    public function getType(): string
    {
        return Asset::TYPE_PERSONAL;
    }

    protected int $category = 0;
}