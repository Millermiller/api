<?php


namespace Scandinaver\Common\Domain\Event\Listener;

use Psr\Log\LoggerInterface;
use \Scandinaver\Common\Domain\Event\LanguageUpdated;

/**
 * Class LanguageUpdatedListener
 *
 * @package Scandinaver\Common\Domain\Event\Listener
 *
 */
class LanguageUpdatedListener
{

    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function handle(LanguageUpdated $event): void
    {
        $language = $event->getLanguage();

        $this->logger->info('Language {title} created', [
            'title' => $language->getTitle()
        ]);
    }
}