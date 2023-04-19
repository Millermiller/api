<?php

namespace Scandinaver\Learning\Asset\Domain\Event\Listener;

use Psr\Log\LoggerInterface;
use Scandinaver\Learning\Asset\Domain\Event\AssetDeleted;

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
            'Словарь удален: {assetname}',
            [
                'assetname' => $event->getAsset()->getTitle(),
            ]
        );
    }
}
