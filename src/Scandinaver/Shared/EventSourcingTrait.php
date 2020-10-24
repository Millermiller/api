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


}