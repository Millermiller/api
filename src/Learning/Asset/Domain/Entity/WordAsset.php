<?php


namespace Scandinaver\Learning\Asset\Domain\Entity;

use Scandinaver\Common\Domain\Entity\Language;
use Scandinaver\Learning\Asset\Domain\Enum\AssetType;

/**
 * Class WordAsset
 *
 * @package Scandinaver\Learn\Domain\Entity
 */
class WordAsset extends Asset
{
    public function __construct(string $title, Language $language)
    {
        $this->type = AssetType::WORDS;

        parent::__construct($title, $language);
    }

    public function getType(): AssetType
    {
        return AssetType::WORDS;
    }
}