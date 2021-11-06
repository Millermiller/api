<?php


namespace Scandinaver\Blog\Domain\Event\Listener;

use Psr\Log\LoggerInterface;
use \Scandinaver\Blog\Domain\Event\PostUpdated;

/**
 * Class PostUpdatedListener
 *
 * @package Scandinaver\Blog\Domain\Event\Listener
 */
class PostUpdatedListener
{

    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function handle(PostUpdated $event): void
    {
        $post = $event->getPost();

        $this->logger->info('Post {title} updated.', [
            'title' => $post->getTitle()
        ]);
    }
}