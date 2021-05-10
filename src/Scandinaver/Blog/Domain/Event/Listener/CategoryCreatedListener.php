<?php


namespace Scandinaver\Blog\Domain\Event\Listener;

use Psr\Log\LoggerInterface;
use \Scandinaver\Blog\Domain\Event\CategoryCreated;

/**
 * Class CategoryCreatedListener
 *
 * @package Scandinaver\Blog\Domain\Event\Listener
 */
class CategoryCreatedListener
{

    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function handle(CategoryCreated $event): void
    {
        $category = $event->getCategory();

        $this->logger->info('Category {title} created.', [
            'title' => $category->getTitle()
        ]);
    }
}