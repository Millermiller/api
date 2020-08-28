<?php


namespace Scandinaver\Shared;

/**
 * Class AggregateRoot
 *
 * @package Scandinaver\Shared
 */
abstract class AggregateRoot
{
    private array $domainEvents = [];

    public abstract function getId(): int;

    public abstract function toDTO();

    final public function pullEvents(): array
    {
        $domainEvents       = $this->domainEvents;
        $this->domainEvents = [];

        return $domainEvents;
    }

    final protected function pushEvent(DomainEvent $domainEvent): void
    {
        $this->domainEvents[] = $domainEvent;
    }
}