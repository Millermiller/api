<?php


namespace Scandinaver\Learning\Asset\Domain\DTO;

use Scandinaver\Core\Domain\DTO;

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