<?php


namespace Scandinaver\Learn\Domain\Model;


class SentenceAsset extends Asset
{
    public function getType(): string
    {
        return Asset::TYPE_SENTENCES;
    }

    protected int $category = 2;
}