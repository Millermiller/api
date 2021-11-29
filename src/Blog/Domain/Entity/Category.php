<?php


namespace Scandinaver\Blog\Domain\Entity;

use DateTime;
use Scandinaver\Blog\Domain\Event\CategoryCreated;
use Scandinaver\Blog\Domain\Event\CategoryDeleted;
use Scandinaver\Blog\Domain\Event\CategoryNameUpdated;
use Scandinaver\Core\Domain\AggregateRoot;

/**
 * Class Category
 *
 * @package Scandinaver\Blog\Domain\Entity
 */
class Category extends AggregateRoot
{

    private int $id;

    private string $title;

    private ?DateTime $createdAt;

    private ?DateTime $updatedAt;

    public function __construct(string $name)
    {
        $this->title = $name;

        // $this->pushEvent(new CategoryCreated($this));
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $name): void
    {
        $this->title = $name;
        $this->pushEvent(new CategoryNameUpdated($this));
    }

    public function onDelete()
    {
        $this->pushEvent(new CategoryDeleted($this));
    }
}
