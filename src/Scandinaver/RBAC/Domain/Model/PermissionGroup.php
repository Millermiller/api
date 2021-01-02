<?php


namespace Scandinaver\RBAC\Domain\Model;


use DateTime;
use Scandinaver\Shared\AggregateRoot;

/**
 * Class Permission
 *
 * @package Scandinaver\RBAC\Domain\Model
 */
class PermissionGroup extends AggregateRoot
{
    private int $id;

    private string $name;

    private string $slug;

    private ?string $description;

    private DateTime $createdAt;

    private DateTime $updatedAt;

    public function getId(): int
    {
        return $this->id;
    }

    public function toDTO(): PermissionGroupDTO
    {
        return new PermissionGroupDTO($this);
    }

    public function delete()
    {
        // TODO: Implement delete() method.
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
    }

}