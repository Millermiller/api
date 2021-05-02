<?php


namespace Scandinaver\Learn\Domain\Event\Listener;

use Psr\Log\LoggerInterface;
use Scandinaver\Learn\Domain\Event\AssetCreated;

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
            'Создан словарь {assetname}',
            [
                'assetname' => $event->getAsset()->getTitle(),
            ]
        );
    }
}
