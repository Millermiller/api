<?php


namespace Scandinaver\Blog\Domain\Event\Listener;

use Psr\Log\LoggerInterface;
use \Scandinaver\Blog\Domain\Event\PostCreated;

/**
 * Class PostCreatedListener
 *
 * @package Scandinaver\Blog\Domain\Event\Listener
 */
class PostCreatedListener
{

    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function handle(PostCreated $event): void
    {
        $post = $event->getPost();

        $this->logger->info('Post {title} created.', [
            'title' => $post->getTitle()
        ]);
    }
}