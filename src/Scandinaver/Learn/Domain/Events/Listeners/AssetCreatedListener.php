<?php


namespace Scandinaver\Learn\Domain\Events\Listeners;

use Psr\Log\LoggerInterface;
use Scandinaver\Learn\Domain\Events\AssetCreated;

/**
 * Class AssetCreatedListener
 *
 * @package Scandinaver\Learn\Domain\Events\Listeners
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
