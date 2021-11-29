<?php


namespace Scandinaver\Learning\Asset\Application\Subscriber;

use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Events\Dispatcher;
use Scandinaver\Common\Domain\Event\Notifications\LanguageCreatedNotification;
use Scandinaver\Common\Domain\Event\Notifications\LanguageDeletedNotification;
use Scandinaver\Learning\Asset\Domain\Exception\LanguageNotFoundException;
use Scandinaver\Learning\Asset\Domain\Service\AssetService;

/**
 * Class LanguageEventsSubscriber
 *
 * @package Scandinaver\Learning\Asset\Application\Subscriber
 */
class LanguageEventsSubscriber implements ShouldQueue
{

    public function __construct(private AssetService $assetService)
    {
    }

    /**
     * @param  LanguageCreatedNotification  $event
     *
     * @throws Exception //TODO: wtf
     */
    public function handleLanguageCreated(LanguageCreatedNotification $event): void
    {
        $language = $event->getLanguage();

        $this->assetService->createDefaultAssets($language->getId());
    }

    /**
     * @param  LanguageDeletedNotification  $event
     *
     * @throws BindingResolutionException
     * @throws LanguageNotFoundException
     */
    public function handleLanguageDeleted(LanguageDeletedNotification $event): void
    {
      //  $language = $event->getLanguage();

      //  $this->assetService->removeByLanguage($language);
    }

    public function subscribe(Dispatcher $events): void
    {
        $events->listen(
            LanguageCreatedNotification::class,
            [LanguageEventsSubscriber::class, 'handleLanguageCreated']
        );

        $events->listen(
            LanguageDeletedNotification::class,
            [LanguageEventsSubscriber::class, 'handleLanguageDeleted']
        );
    }
}