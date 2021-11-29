<?php


namespace Scandinaver\Blog\Domain\Event\Listener;

use Psr\Log\LoggerInterface;
use Scandinaver\Blog\Domain\Event\CategoryDeleted;

/**
 * Class CategoryDeletedListener
 *
 * @package Scandinaver\Blog\Domain\Event\Listener
 */
class CategoryDeletedListener
{

    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param  CategoryDeleted  $event
     */
    public function handle(CategoryDeleted $event)
    {
        $this->logger->info('Категория {name} удалена',
            [
                'name' => $event->getCategory()->getTitle(),
            ]);
    }
}