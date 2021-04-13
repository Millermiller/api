<?php


namespace Scandinaver\Blog\Domain\Model;

use DateTime;
use Scandinaver\Blog\Domain\Events\CategoryDeleted;
use Scandinaver\Blog\Domain\Events\CategoryNameUpdated;
use Scandinaver\Shared\AggregateRoot;

/**
 * Class Category
 *
 * @package Scandinaver\Blog\Domain\Model
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
    }

    public function getId(): int
    {
        return $this->id;
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

    public function delete()
    {
        $this->pushEvent(new CategoryDeleted($this));
    }
}
