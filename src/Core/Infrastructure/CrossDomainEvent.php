<?php


namespace Scandinaver\Core\Infrastructure;

use Illuminate\Foundation\Events\Dispatchable;
use Scandinaver\Core\Domain\Contract\CrossDomainEventInterface;

/**
 * Class CrossDomainEvent
 *
 * @package Scandinaver\Core\Infrastructure
 */
class CrossDomainEvent implements CrossDomainEventInterface
{
    use Dispatchable;
}