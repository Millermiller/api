<?php


namespace Scandinaver\Core\Domain\Contract;

/**
 * Interface ValueObjectInterface
 *
 * @package Scandinaver\Core\Domain\Contract
 */
interface ValueObjectInterface
{
    public function __toString(): string;

    public function isSame(ValueObjectInterface $object): bool;

    public function toNative();
}