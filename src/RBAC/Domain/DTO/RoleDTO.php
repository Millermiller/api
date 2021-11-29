<?php


namespace Scandinaver\RBAC\Domain\DTO;

use Scandinaver\RBAC\Domain\Entity\Role;
use Scandinaver\Core\Domain\DTO;

/**
 * Class RoleDTO
 *
 * @package Scandinaver\RBAC\Domain\Entity
 */
class RoleDTO extends DTO
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

    public static function fromArray(array $data): RoleDTO
    {
        $roleDTO = new self();

        $roleDTO->setId($data['id'] ?? NULL);
        $roleDTO->setName($data['name']);
        $roleDTO->setSlug($data['slug']);
        $roleDTO->setDescription($data['description'] ?? NULL);

        return $roleDTO;
    }
}