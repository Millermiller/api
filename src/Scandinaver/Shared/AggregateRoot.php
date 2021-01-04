<?php


namespace Scandinaver\Shared;

use Scandinaver\Shared\Contract\EqualInterface;

/**
 * Class AggregateRoot
 *
 * @package Scandinaver\Shared
 */
abstract class AggregateRoot implements EqualInterface
{
    private array $domainEvents = [];

    abstract public function getId(): int;

    abstract public function toDTO(): DTO;

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

    abstract public function delete();
}