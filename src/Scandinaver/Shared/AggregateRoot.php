<?php


namespace Scandinaver\Shared;

abstract class AggregateRoot
{
    private array $domainEvents = [];

    public abstract function getId(): int;

    public abstract function toDTO(): DTO;

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