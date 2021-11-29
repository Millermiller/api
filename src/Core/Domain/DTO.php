<?php


namespace Scandinaver\Core\Domain;

/**
 * Class DTO
 *
 * @package Scandinaver\Core\Domain
 */
abstract class DTO
{
    abstract public static function fromArray(array $data): self;
}