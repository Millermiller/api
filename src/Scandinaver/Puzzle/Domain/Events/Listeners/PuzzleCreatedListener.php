<?php


namespace Scandinaver\Puzzle\Domain\Events\Listeners;

use Psr\Log\LoggerInterface;
use Scandinaver\Puzzle\Domain\Events\PuzzleCreated;

/**
 * Class PuzzleCreatedListener
 *
 * @package Scandinaver\Puzzle\Domain\Events\Listeners
 */
class PuzzleCreatedListener
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param  PuzzleCreated  $event
     */
    public function handle(PuzzleCreated $event)
    {
        $this->logger->info('puzzle created');
    }
}