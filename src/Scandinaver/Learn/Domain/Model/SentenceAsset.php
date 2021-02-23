<?php


namespace Scandinaver\Learn\Domain\Model;


/**
 * Class SentenceAsset
 *
 * @package Scandinaver\Learn\Domain\Model
 */
class SentenceAsset extends Asset
{
    public function getType(): int
    {
        return Asset::TYPE_SENTENCES;
    }

    protected int $category = Asset::TYPE_SENTENCES;
}