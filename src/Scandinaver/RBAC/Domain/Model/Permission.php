<?php


namespace Scandinaver\RBAC\Domain\Model;


use DateTime;
use Scandinaver\Shared\AggregateRoot;
use Scandinaver\Shared\DTO;

/**
 * Class Permission
 *
 * @package Scandinaver\User\Domain\Model
 */
class Permission extends AggregateRoot
{
    private int $id;

    private string $name;

    private string $slug;

    private string $description;

    private DateTime $createdAt;

    private DateTime $updatedAt;

    public function getId(): int
    {
        return $this->id;
    }

    public function toDTO(): DTO
    {
        // TODO: Implement toDTO() method.
    }

    public function delete()
    {
        // TODO: Implement delete() method.
    }
}