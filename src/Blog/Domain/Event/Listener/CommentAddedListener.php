<?php


namespace Scandinaver\Blog\Domain\Event\Listener;

use Psr\Log\LoggerInterface;
use Scandinaver\Blog\Domain\Event\CommentAdded;

/**
 * Class CommentAddedListener
 *
 * @package Scandinaver\Blog\Domain\Event\Listener
 */
class CommentAddedListener
{

    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function handle(CommentAdded $event): void
    {
        $comment = $event->getComment();

        $this->logger->info('Comment id:{id} created', [
            'id' => $comment->getId()
        ]);
    }
}