<?php


namespace Scandinaver\Puzzle\Domain\Events\Listeners;

use Scandinaver\Puzzle\Domain\Events\TestCreated;

/**
 * Class TestCreatedListener
 *
 * @package Scandinaver\Puzzle\Domain\Events\Listeners
 *
 */
class TestCreatedListener
{
    public function __construct()
    {
    }

    /**
     * @param  TestCreated  $event
     */
    public function handle(TestCreated $event)
    {
    }
}