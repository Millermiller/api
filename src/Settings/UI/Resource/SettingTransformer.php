<?php


namespace Scandinaver\Settings\UI\Resource;


use JetBrains\PhpStorm\ArrayShape;
use League\Fractal\TransformerAbstract;
use Scandinaver\Settings\Domain\Entity\Setting;

/**
 * Class SettingTransformer
 *
 * @package Scandinaver\Settings\UI\Resource
 */
class SettingTransformer extends TransformerAbstract
{

    #[ArrayShape([
        'id'    => "int",
        'title' => "string",
        'slug'  => "string",
        'type'  => "null|string",
        'value' => "mixed|null",
    ])]
    public function transform(Setting $setting): array
    {
        return [
            'id'    => $setting->getId(),
            'title' => $setting->getTitle(),
            'slug'  => $setting->getSlug(),
            'type'  => $setting->getType(),
            'value' => $setting->getValue(),
        ];
    }
}