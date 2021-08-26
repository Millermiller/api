<?php


namespace Scandinaver\Settings\Domain\DTO;

use Scandinaver\Shared\DTO;

/**
 * Class SettingDTO
 *
 * @package Scandinaver\Settings\Domain\DTO
 */
class SettingDTO extends DTO
{

    private string $title;

    private string $slug;

    private string $type;

    private ?string $description = NULL;

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }


    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public static function fromArray(array $data): SettingDTO
    {
        $settingDTO = new self();
        $settingDTO->setTitle($data['title']);
        $settingDTO->setSlug($data['slug']);
        $settingDTO->setType($data['type']);
        $settingDTO->setDescription($data['description'] ?? NULL);

        return $settingDTO;
    }
}