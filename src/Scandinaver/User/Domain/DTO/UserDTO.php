<?php


namespace Scandinaver\User\Domain\DTO;

use Scandinaver\Shared\DTO;

/**
 * Class UserDTO
 *
 * @package Scandinaver\User\Domain\Model
 */
class UserDTO extends DTO
{
    public static function fromArray(array $data): UserDTO
    {
        return new self();
    }
}