<?php


namespace Scandinaver\Blog\Domain\Events\Listeners;

use Psr\Log\LoggerInterface;
use Scandinaver\Blog\Domain\Events\CategoryNameUpdated;

/**
 * Class CategoryNameUpdatedListener
 *
 * @package Scandinaver\Blog\Domain\Events\Listeners
 */
class CategoryNameUpdatedListener
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param  CategoryNameUpdated  $event
     */
    public function handle(CategoryNameUpdated $event)
    {
        $this->logger->info('Название категории id:{id} изменено на {name}',
            [
                'id'   => $event->getCategory()->getId(),
                'name' => $event->getCategory()->getTitle(),
            ]);
    }
}