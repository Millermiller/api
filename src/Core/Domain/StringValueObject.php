<?php


namespace Scandinaver\Core\Domain;

use Scandinaver\Core\Domain\Contract\ValueObjectInterface;

/**
 * Class StringValueObject
 *
 * @package Scandinaver\Core\Domain
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