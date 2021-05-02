<?php


namespace Scandinaver\Puzzle\Domain\Event\Listener;

use Psr\Log\LoggerInterface;
use Scandinaver\Puzzle\Domain\Event\PuzzleCreated;

/**
 * Class PuzzleCreatedListener
 *
 * @package Scandinaver\Puzzle\Domain\Event\Listener
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