<?php


namespace Scandinaver\RBAC\Domain\DTO;

use Scandinaver\RBAC\Domain\Permission\PermissionGroup;
use Scandinaver\Shared\DTO;

/**
 * Class PermissionGroupDTO
 *
 * @package Scandinaver\RBAC\Domain\Entity
 */
class PermissionGroupDTO extends DTO
{
    private ?int $id;

    private string $name;

    private string $slug;

    private ?string $description;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
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

    public static function fromArray(array $data): PermissionGroupDTO
    {
        $permissionGroupDTO = new self();

        $permissionGroupDTO->setName($data['name']);
        $permissionGroupDTO->setSlug($data['slug']);
        $permissionGroupDTO->setDescription($data['description'] ?? NULL);

        return $permissionGroupDTO;
    }
}