<?php


namespace Scandinaver\Blog\Domain\Event\Listener;

use Psr\Log\LoggerInterface;
use \Scandinaver\Blog\Domain\Event\PostDeleted;

/**
 * Class PostDeletedListener
 *
 * @package Scandinaver\Blog\Domain\Event\Listener
 */
class PostDeletedListener
{

    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function handle(PostDeleted $event): void
    {
        $post = $event->getPost();

        $this->logger->info('Post {title} deleted.', [
            'title' => $post->getTitle()
        ]);
    }
}