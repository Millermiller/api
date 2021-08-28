<?php


namespace Scandinaver\Common\Domain\Entity;

use LaravelDoctrine\ORM\Contracts\UrlRoutable;
use Scandinaver\Common\Domain\Event\LanguageCreated;
use Scandinaver\Common\Domain\Event\LanguageDeleted;
use Scandinaver\Shared\AggregateRoot;

/**
 * Class Language
 *
 * @package Scandinaver\Common\Domain\Entity
 */
class Language extends AggregateRoot implements UrlRoutable
{
    private ?int $id = NULL;

    private string $letter;

    private string $title;

    private ?string $description = NULL;

    private string $flag;

    private string $image;

    public function __construct()
    {
        $this->pushEvent(new LanguageCreated($this));
    }

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
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getLetter(): string
    {
        return $this->letter;
    }

    public function setLetter(string $letter): void
    {
        $this->letter = $letter;
    }

    public function getFlag(): string
    {
        return $this->flag;
    }

    public function setFlag(string $flag): void
    {
        $this->flag = $flag;
    }

    public function onDelete()
    {
        $this->pushEvent(new LanguageDeleted($this));
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function setImage(string $image): void
    {
        $this->image = $image;
    }
}
