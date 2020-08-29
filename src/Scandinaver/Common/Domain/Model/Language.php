<?php


namespace Scandinaver\Common\Domain\Model;

use JsonSerializable;
use LaravelDoctrine\ORM\Contracts\UrlRoutable;

/**
 * Class Language
 *
 * @package Scandinaver\Common\Domain\Model
 */
class Language implements UrlRoutable
{
    private int $id;

    private string $name;

    private string $label;

    private string $flag;

    public static function getRouteKeyName(): string
    {
        return 'name';
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function setLabel(string $label): void
    {
        $this->label = $label;
    }

    public function getFlag(): string
    {
        return $this->flag;
    }

    public function setFlag(string $flag): void
    {
        $this->flag = $flag;
    }
}
