<?php


namespace Scandinaver\Common\Domain\Event\Listener;

use Illuminate\Contracts\Container\BindingResolutionException;
use Psr\Log\LoggerInterface;
use Scandinaver\Common\Domain\Event\LanguageDeleted;
use Scandinaver\Learning\Asset\Domain\Exception\LanguageNotFoundException;
use Scandinaver\Learning\Asset\Domain\Service\AssetService;

/**
 * Class LanguageDeletedListener
 *
 * @package Scandinaver\Common\Domain\Event\Listener
 *
 */
class LanguageDeletedListener
{

    private LoggerInterface $logger;

    private AssetService $assetService;

    public function __construct(
        LoggerInterface $logger,
        AssetService $assetService
    ) {
        $this->logger       = $logger;
        $this->assetService = $assetService;
    }

    /**
     * @param  LanguageDeleted  $event
     *
     * @throws BindingResolutionException
     * @throws LanguageNotFoundException
     */
    public function handle(LanguageDeleted $event): void
    {
        $language = $event->getLanguage();

        $this->assetService->removeByLanguage($language);

        $this->logger->info('Language {title} deleted',
            [
                'title' => $language->getTitle(),
            ]);
    }
}