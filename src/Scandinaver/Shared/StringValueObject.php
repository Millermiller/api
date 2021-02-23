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

    public function isNull(): bool
    {
        return $this->value === null;
    }

    public function isSame(ValueObject $object): bool
    {
        return $this->toNative() === $object->toNative();
    }

    /**
     * @param $native
     *
     * @return mixed|void
     */
    public function fromNative($native)
    {
        $this->value = $native;
    }

    /**
     * @return string
     */
    public function toNative(): string
    {
        return $this->value;
    }
}