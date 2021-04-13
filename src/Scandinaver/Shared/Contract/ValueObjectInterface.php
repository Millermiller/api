<?php


namespace Scandinaver\Shared\Contract;

use Scandinaver\Shared\ValueObject;

/**
 * Interface ValueObjectInterface
 *
 * @package Scandinaver\Shared\Contract
 */
interface ValueObjectInterface
{
    public function isNull(): bool;

    public function isSame(ValueObject $object): bool;

    /**
     * @param $native
     *
     * @return mixed
     */
    public function fromNative($native);

    public function toNative();
}