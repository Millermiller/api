<?php


namespace Scandinaver\Settings\Domain\Service;

use Scandinaver\Settings\Domain\DTO\SettingDTO;
use Scandinaver\Settings\Domain\Model\Setting;

/**
 * Class SettingFactory
 *
 * @package Scandinaver\Settings\Domain\Services
 */
class SettingFactory
{
    public static function fromDTO(SettingDTO $settingDTO): Setting
    {
        $setting = new Setting();

        $setting->setTitle($settingDTO->getTitle());
        $setting->setSlug($settingDTO->getSlug());
        $setting->setType($settingDTO->getType());

        return $setting;
    }

    public static function toDTO(Setting $setting): SettingDTO
    {
        return SettingDTO::fromArray([
            'title' => $setting->getTitle(),
            'slug' => $setting->getSlug(),
            'type' => $setting->getType(),
        ]);
    }
}