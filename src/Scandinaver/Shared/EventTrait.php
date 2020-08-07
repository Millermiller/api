<?php


namespace Scandinaver\Shared;

/**
 * Trait EventTrait
 *
 * @package Scandinaver\Shared
 */
trait EventTrait
{

    /**
     * @var DomainEvent[]
     */
    private array $events = [];

    protected function recordEvent(DomainEvent $event): void
    {
        $this->events[] = $event;
    }

    /**
     * @return DomainEvent[]
     */
    public function releaseEvents(): array
    {
        $events = $this->events;
        $this->events = [];

        return $events;
    }

}