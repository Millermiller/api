<?php


namespace Scandinaver\Billing\Domain\Entity;

use DateTime;
use Ramsey\Uuid\UuidInterface;
use Scandinaver\Core\Domain\Contract\UserInterface;
use Scandinaver\Core\Infrastructure\Persistence\Doctrine\UuidTrait;

/**
 * Class Order
 *
 * @package Scandinaver\Billing\Domain\Entity
 */
class Order
{
    use UuidTrait;

    protected UuidInterface $id;

    private UserInterface $user;

    private Payment $payment;

    private Service $service;

    private DateTime $createdAt;

    private DateTime $updatedAt;

    public function __construct()
    {
        // $this->uuid();
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getService(): Service
    {
        return $this->service;
    }

    public function getUser(): UserInterface
    {
        return $this->user;
    }

    public function getPayment(): Payment
    {
        return $this->payment;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }
}
