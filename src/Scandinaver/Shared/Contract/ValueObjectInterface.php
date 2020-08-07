<?php


namespace Scandinaver\Shared\Contract;


use Scandinaver\Shared\ValueObject;

interface ValueObjectInterface
{

    /**
     * @return bool
     */
    public function isNull(): bool;

    /**
     * @param  ValueObject  $object
     *
     * @return bool
     */
    public function isSame(ValueObject $object): bool;

    /**
     * @param  mixed  $native
     *
     * @return mixed
     */
    public function fromNative($native);

    /**
     * @return mixed
     */
    public function toNative();

}