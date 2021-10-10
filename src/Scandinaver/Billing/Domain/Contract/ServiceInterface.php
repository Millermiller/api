<?php


namespace Scandinaver\Billing\Domain\Contract;


use Ramsey\Uuid\UuidInterface;
use Scandinaver\Billing\Domain\Entity\Cost;
use Scandinaver\Billing\Domain\Entity\ServiceType;

/**
 * Interface ServiceInterface
 *
 * @package Scandinaver\Billing\Domain\Contract
 */
interface ServiceInterface
{
    public function getType(): ServiceType;

    public function getItemId(): UuidInterface;
}