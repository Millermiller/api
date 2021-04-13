<?php


namespace Scandinaver\RBAC\Domain\Model;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Exception;
use Scandinaver\Shared\AggregateRoot;

/**
 * Class Role
 *
 * @package Scandinaver\RBAC\Domain\Model
 */
class Role extends AggregateRoot
{
    private int $id;

    private string $name;

    private string $slug;

    private ?string $description;

    private DateTime $createdAt;

    private DateTime $updatedAt;

    /**
     * @var Collection | Permission[]
     */
    private Collection $permissions;

    public function __construct()
    {
        $this->permissions = new ArrayCollection();
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

    public function attachPermission(Permission $permission): void
    {
        if ($this->permissions->contains($permission)) {
            throw new Exception('Permission already assigned');
        }

        $this->permissions->add($permission);
    }

    public function detachPermission(Permission $permission): void
    {
        if (!$this->permissions->contains($permission)) {
            throw new Exception('Permission not assigned');
        }

        $this->permissions->removeElement($permission);
    }

    public function hasPermission(Permission $permission): bool
    {
        return $this->permissions->contains($permission);
    }

    public function clearPermissions()
    {
        $this->permissions->clear();
    }

    /**
     * @return Collection|Permission[]
     */
    public function getPermissions(): Collection
    {
        return $this->permissions;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function delete()
    {
        // TODO: Implement delete() method.
    }
}