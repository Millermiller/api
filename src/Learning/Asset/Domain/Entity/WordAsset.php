<?php


namespace Scandinaver\Learning\Asset\Domain\Entity;

use Scandinaver\Learning\Asset\Domain\Contract\AssetInterface;

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