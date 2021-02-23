<?php


namespace Scandinaver\Blog\Domain\Events\Listeners;


use Psr\Log\LoggerInterface;
use Scandinaver\Blog\Domain\Events\CategoryDeleted;

/**
 * Class CategoryDeletedListener
 *
 * @package Scandinaver\Blog\Domain\Events\Listeners
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
        $this->logger->info('Категория {name} удалена', [
            'name' => $event->getCategory()->getName(),
        ]);
    }
}