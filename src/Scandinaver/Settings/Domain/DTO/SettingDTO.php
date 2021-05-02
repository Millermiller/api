<?php


namespace Scandinaver\Settings\Domain\DTO;

/**
 * Class SettingDTO
 *
 * @package Scandinaver\Settings\Domain\DTO
 */
class SettingDTO
{
    private string $title;

    private string $slug;

    private string $type;

    public function __construct(string $title, string $slug, string $type)
    {
        $this->title = $title;

        $this->slug = $slug;

        $this->type = $type;
    }

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
}