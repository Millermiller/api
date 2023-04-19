<?php


namespace Scandinaver\Learning\Asset\Domain\Entity;

use Scandinaver\Common\Domain\Entity\Language;
use Scandinaver\Learning\Asset\Domain\Enum\AssetType;

/**
 * Class PersonalAsset
 *
 * @package Scandinaver\Learn\Domain\Entity
 */
class PersonalAsset extends Asset
{
    public function __construct(string $title, Language $language)
    {
        $this->type = AssetType::PERSONAL;

        parent::__construct($title, $language);
    }

    public function getType(): AssetType
    {
        return AssetType::PERSONAL;
    }
}