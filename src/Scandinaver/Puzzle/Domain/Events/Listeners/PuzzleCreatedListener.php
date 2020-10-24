<?php


namespace Scandinaver\Puzzle\Domain\Events\Listeners;

use Psr\Log\LoggerInterface;
use Scandinaver\Puzzle\Domain\Events\PuzzleCreated;

class PuzzleCreatedListener
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function handle(PuzzleCreated $event)
    {
        $this->logger->info('puzzle created');
    }
}