<?php


namespace Scandinaver\Billing\Domain\Entity;

use Ramsey\Uuid\UuidInterface;
use Scandinaver\Billing\Domain\Contract\ServiceInterface;

/**
 * Class Service
 *
 * @package Scandinaver\Billing\Domain\Entity
 */
class Service implements ServiceInterface
{

    protected UuidInterface $id;

    private ServiceType $type;

    private UuidInterface $itemId;

    public function __construct(ServiceType $type, UuidInterface $itemId)
    {
        $this->type   = $type;
        $this->itemId = $itemId;
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getType(): ServiceType
    {
        return $this->type;
    }

    public function getItemId(): UuidInterface
    {
        return $this->itemId;
    }
}