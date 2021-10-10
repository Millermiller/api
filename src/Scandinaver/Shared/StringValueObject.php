<?php


namespace Scandinaver\Shared;

use Scandinaver\Shared\Contract\ValueObjectInterface;

/**
 * Class ValueObject
 *
 * @package Scandinaver\Shared
 */
class StringValueObject implements ValueObjectInterface
{
    protected string $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    public function __toString(): string
    {
        return $this->value;
    }

    public function isSame(ValueObjectInterface $object): bool
    {
        if (static::class !== get_class($object)) {
            return FALSE;
        }

        return $this->toNative() === $object->toNative();
    }

    public function toNative(): string
    {
        return $this->value;
    }
}