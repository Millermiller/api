<?php


namespace Scandinaver\Blog\Domain\Model;

use DateTime;
use Scandinaver\Blog\Domain\Events\CategoryDeleted;
use Scandinaver\Blog\Domain\Events\CategoryNameUpdated;
use Scandinaver\Shared\AggregateRoot;
use Scandinaver\Shared\DTO;

/**
 * Class Category
 *
 * @package Scandinaver\Blog\Domain\Model
 */
class Category extends AggregateRoot
{
    private int $id;

    private string $name;

    private ?DateTime $createdAt;

    private ?DateTime $updatedAt;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function toDTO(): CategoryDTO
    {
        return new CategoryDTO($this);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
        $this->pushEvent(new CategoryNameUpdated($this));
    }

    public function delete()
    {
        $this->pushEvent(new CategoryDeleted($this));
    }
}
