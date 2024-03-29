<?php


namespace Scandinaver\RBAC\Domain\Entity;

use DateTime;
use Scandinaver\Core\Domain\AggregateRoot;

/**
 * Class Permission
 *
 * @package Scandinaver\RBAC\Domain\Entity
 */
class Permission extends AggregateRoot
{

    private int $id;

    private string $name;

    private string $slug;

    private ?string $description;

    private ?PermissionGroup $group = NULL;

    private DateTime $createdAt;

    private DateTime $updatedAt;

    public function __construct(string $slug)
    {
        $this->slug  = $slug;
        $this->group = new PermissionGroup();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function onDelete()
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

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function getGroup(): ?PermissionGroup
    {
        return $this->group;
    }

    public function setGroup(?PermissionGroup $group): void
    {
        $this->group = $group;
    }
}