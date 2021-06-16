<?php


namespace Scandinaver\Learn\Domain\Entity;

use Scandinaver\Learn\Domain\Contract\AssetInterface;

/**
 * Class WordAsset
 *
 * @package Scandinaver\Learn\Domain\Entity
 */
class WordAsset extends Asset implements AssetInterface
{
    public function getType(): int
    {
        return Asset::TYPE_WORDS;
    }

    protected int $category = Asset::TYPE_WORDS;
}