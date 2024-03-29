<?php


namespace Scandinaver\Learning\Asset\Domain\Event\Listener;

use Psr\Log\LoggerInterface;
use Scandinaver\Learning\Asset\Domain\Event\AssetCreated;

/**
 * Class AssetCreatedListener
 *
 * @package Scandinaver\Learn\Domain\Event\Listener
 */
class AssetCreatedListener
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function handle(AssetCreated $event): void
    {
        $this->logger->info(
            'Словарь создан: {assetname}',
            [
                'assetname' => $event->getAsset()->getTitle(),
            ]
        );
    }
}
