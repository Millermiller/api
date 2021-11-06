<?php


namespace Scandinaver\Common\Domain\Event\Listener;

use Psr\Log\LoggerInterface;
use Scandinaver\Common\Domain\Event\LanguageCreated;
use Scandinaver\Learning\Asset\Domain\Service\AssetService;

/**
 * Class LanguageCreatedListener
 *
 * @package Scandinaver\Common\Domain\Event\Listener
 */
class LanguageCreatedListener
{
    private LoggerInterface $logger;

    private AssetService $assetService;

    public function __construct(LoggerInterface $logger, AssetService $assetService)
    {
        $this->logger       = $logger;
        $this->assetService = $assetService;
    }

    public function handle(LanguageCreated $event): void
    {
        $language = $event->getLanguage();

        $this->assetService->createDefaultAssets($language);

        $this->logger->info('language {title} created',
            [
                'title' => $language->getTitle(),
            ]);
    }
}