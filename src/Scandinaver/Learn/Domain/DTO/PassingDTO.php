<?php


namespace Scandinaver\Learn\Domain\DTO;

use Scandinaver\Shared\DTO;

/**
 * Class PassingDTO
 *
 * @package Scandinaver\Learn\Domain\Entity
 */
class PassingDTO extends DTO
{
    public static function fromArray(array $data): PassingDTO
    {
        return new self();
    }
}