<?php


namespace Scandinaver\Blog\Domain\Event\Listener;

use Psr\Log\LoggerInterface;
use \Scandinaver\Blog\Domain\Event\CommentUpdated;

/**
 * Class CommentUpdatedListener
 *
 * @package Scandinaver\Blog\Domain\Event\Listener
 */
class CommentUpdatedListener
{

    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function handle(CommentUpdated $event): void
    {
        $comment = $event->getComment();

        $this->logger->info('Comment id:{id} updated.', [
            'id' => $comment->getId()
        ]);
    }
}