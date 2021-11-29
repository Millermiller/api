<?php


namespace Scandinaver\Core\Domain;

use Scandinaver\Core\Domain\Contract\DomainEvent;
use Scandinaver\Core\Domain\Contract\EqualInterface;

/**
 * Class AggregateRoot
 *
 * @package Scandinaver\Core\Domain
 */
abstract class AggregateRoot implements EqualInterface
{
    private array $domainEvents = [];

    abstract public function getId(): int;

    public function isEqualTo(EqualInterface $to): bool
    {
        return (string)$to->getId() === (string)$this->getId();
    }

    final public function pullEvents(): array
    {
        $domainEvents = $this->domainEvents;
        $this->domainEvents = [];

        return $domainEvents;
    }

    final protected function pushEvent(DomainEvent $domainEvent): void
    {
        $this->domainEvents[] = $domainEvent;
    }

    abstract public function onDelete();
}