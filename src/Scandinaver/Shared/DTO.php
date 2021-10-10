<?php


namespace Scandinaver\Shared;

/**
 * Class DTO
 *
 * @package Scandinaver\Shared
 */
abstract class DTO
{
    abstract public static function fromArray(array $data): self;
}