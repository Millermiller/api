<?php


namespace Scandinaver\Learning\Puzzle\Domain\Event\Listener;

use Scandinaver\Learning\Puzzle\Domain\Event\TestCreated;

/**
 * Class TestCreatedListener
 *
 * @package Scandinaver\Puzzle\Domain\Event\Listener
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