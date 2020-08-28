<?php


namespace Scandinaver\Shared\Contract;


use Scandinaver\Shared\ValueObject;

interface ValueObjectInterface
{
    public function isNull(): bool;

    public function isSame(ValueObject $object): bool;

    public function fromNative($native);

    public function toNative();
}