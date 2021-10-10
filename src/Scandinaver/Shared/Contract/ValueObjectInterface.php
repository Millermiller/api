<?php


namespace Scandinaver\Shared\Contract;

/**
 * Interface ValueObjectInterface
 *
 * @package Scandinaver\Shared\Contract
 */
interface ValueObjectInterface
{
    public function __toString(): string;

    public function isSame(ValueObjectInterface $object): bool;

    public function toNative();
}