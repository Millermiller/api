<?php


namespace Scandinaver\Learn\Domain\Entity;


/**
 * Class SentenceAsset
 *
 * @package Scandinaver\Learn\Domain\Entity
 */
class SentenceAsset extends Asset
{
    public function getType(): int
    {
        return Asset::TYPE_SENTENCES;
    }

    protected int $category = Asset::TYPE_SENTENCES;
}