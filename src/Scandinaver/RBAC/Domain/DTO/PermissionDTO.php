<?php


namespace Scandinaver\RBAC\Domain\DTO;

use Scandinaver\Shared\DTO;

/**
 * Class RoleDTO
 *
 * @package Scandinaver\RBAC\Domain\Entity
 */
class PermissionDTO extends DTO
{

    private string $slug;

    private string $name;

    private int $groupId;

    private ?string $description;

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getGroupId(): int
    {
        return $this->groupId;
    }

    public function setGroupId(int $groupId): void
    {
        $this->groupId = $groupId;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public static function fromArray(array $data): PermissionDTO
    {
        $permissionDTO = new self();

        $permissionDTO->setName($data['name']);
        $permissionDTO->setSlug($data['slug']);
        $permissionDTO->setDescription($data['description'] ?? NULL);
        $permissionDTO->setGroupId($data['group']);

        return $permissionDTO;
    }
}