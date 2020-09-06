<?php


namespace Scandinaver\Blog\Domain\Model;

use DateTime;
use JsonSerializable;
use Scandinaver\Shared\AggregateRoot;
use Scandinaver\Shared\Contract\Collection;
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

    private Collection $posts;

    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return Collection|Post[]
     */
    public function getPosts(): Collection
    {
        return $this->posts;
    }

    public function toDTO(): DTO
    {
        return new CategoryDTO($this);
    }

    public function getName(): string
    {
        return $this->name;
    }
}
