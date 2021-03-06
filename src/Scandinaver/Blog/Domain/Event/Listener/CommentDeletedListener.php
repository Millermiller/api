<?php


namespace Scandinaver\Blog\Domain\Event\Listener;

use Psr\Log\LoggerInterface;
use \Scandinaver\Blog\Domain\Event\CommentDeleted;

/**
 * Class CommentDeletedListener
 *
 * @package Scandinaver\Blog\Domain\Event\Listener
 */
class CommentDeletedListener
{

    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function handle(CommentDeleted $event): void
    {
        $comment = $event->getComment();

        $this->logger->info('Comment id:{id} deleted', [
            'id' => $comment->getId()
        ]);
    }
}