<?php


namespace Scandinaver\Shared;

/**
 * Trait EventSourcingTrait
 *
 * @package Scandinaver\Shared
 */
trait EventSourcingTrait
{
    private EventBus $eventBus;

    public function __construct(EventBus $eventBus)
    {
        $this->eventBus = $eventBus;
    }

    private function fireEvents(object $entity) {
        if ($entity instanceof AggregateRoot) {
            $events = $entity->pullEvents();
            foreach ($events as $event) {
                $this->eventBus->handle($event);
            }
        }
    }
}