<?php


namespace Scandinaver\Settings\UI\Resource;


use League\Fractal\Resource\Primitive;
use League\Fractal\TransformerAbstract;
use Scandinaver\Settings\Domain\Entity\Setting;

/**
 * Class SettingTransformer
 *
 * @package Scandinaver\Settings\UI\Resource
 */
class SettingTransformer extends TransformerAbstract
{

    public function transform(Setting $setting): array
    {
        return [
            'id' => $setting->getId(),
            'title' => $setting->getTitle(),
            'slug' => $setting->getSlug(),
            'type' => $setting->getType(),
            'value' => $setting->getValue(),
        ];
    }
}