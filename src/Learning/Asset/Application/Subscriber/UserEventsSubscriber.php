<?php


namespace Scandinaver\Learning\Asset\Application\Subscriber;


use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Events\Dispatcher;
use Scandinaver\User\Domain\Event\Notifications\UserCreatedNotification;

/**
 * Class UserEventsSubscriber
 *
 * @package Scandinaver\Learning\Asset\Domain\Subscribers
 */
class UserEventsSubscriber implements ShouldQueue
{

    public function subscribe(Dispatcher $events): void
    {
        $events->listen(
            UserCreatedNotification::class,
            [UserEventsSubscriber::class, 'handleUserLogin']
        );
    }
}