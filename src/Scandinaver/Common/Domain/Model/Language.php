<?php


namespace Scandinaver\Common\Domain\Model;

use LaravelDoctrine\ORM\Contracts\UrlRoutable;
use Scandinaver\Shared\AggregateRoot;

/**
 * Class Language
 *
 * @package Scandinaver\Common\Domain\Model
 */
class Language extends AggregateRoot implements UrlRoutable
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

    public function getTitle(): string
    {
        return $this->name;
    }

    public function setTitle(string $name): void
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

    public function delete()
    {
        // TODO: Implement delete() method.
    }
}
