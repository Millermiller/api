<?php

namespace Scandinaver\Learn\Domain\Event\Listener;

use Psr\Log\LoggerInterface;
use Scandinaver\Learn\Domain\Event\AssetDeleted;

/**
 * Class AssetDeletedListener
 *
 * @package Scandinaver\Learn\Domain\Event\Listener
 */
class AssetDeletedListener
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function handle(AssetDeleted $event): void
    {
        $this->logger->info(
            'Словарь {assetname} удален',
            [
                'assetname' => $event->getAsset()->getTitle(),
            ]
        );
    }
}
