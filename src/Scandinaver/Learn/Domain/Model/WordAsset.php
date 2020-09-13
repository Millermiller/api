<?php


namespace Scandinaver\Learn\Domain\Model;


use Scandinaver\Learn\Domain\Contract\AssetInterface;

class WordAsset extends Asset implements AssetInterface
{
    public function getType(): string
    {
        return Asset::TYPE_WORDS;
    }

    protected int $category = 1;
}