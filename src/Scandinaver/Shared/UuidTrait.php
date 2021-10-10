<?php


namespace Scandinaver\Shared;


use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * Trait UuidTrait
 *
 * @package Scandinaver\Shared
 */
trait UuidTrait
{
    protected UuidInterface $id;

    public function uuid(): void
    {
        $this->id = Uuid::uuid4();
    }
}