<?php

namespace Scandinaver\Learn\Domain\Events\Listeners;


use Psr\Log\LoggerInterface;
use Scandinaver\Learn\Domain\Events\AssetDeleted;

/**
 * Class AssetDeletedListener
 *
 * @package Scandinaver\Learn\Domain\Events\Listeners
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
