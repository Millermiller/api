<?php


namespace Scandinaver\Learning\Asset\Domain\Entity;

use Scandinaver\Common\Domain\Entity\Language;
use Scandinaver\Learning\Asset\Domain\Enum\AssetType;

/**
 * Class SentenceAsset
 *
 * @package Scandinaver\Learn\Domain\Entity
 */
class SentenceAsset extends Asset
{
    public function __construct(string $title, Language $language)
    {
        $this->type = AssetType::SENTENCES;

        parent::__construct($title, $language);
    }

    public function getType(): AssetType
    {
        return AssetType::SENTENCES;
    }
}