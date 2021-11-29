<?php


namespace Scandinaver\Billing\Domain\Entity;

use DateTime;
use Ramsey\Uuid\UuidInterface;
use Scandinaver\Core\Domain\Contract\UserInterface;
use Scandinaver\Core\Infrastructure\Persistence\Doctrine\UuidTrait;

/**
 * Class Payment
 *
 * @package Scandinaver\Billing\Domain\Entity
 */
class Payment
{
    use UuidTrait;

    protected UuidInterface $id;

    private float $amount;

    private UserInterface $user;

    private array $data;

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

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }
}