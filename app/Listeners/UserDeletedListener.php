<?php


namespace App\Listeners;

use App\Events\UserUpdated;

/**
 * Class UserDeletedListener
 *
 * @package App\Listeners
 */
class UserDeletedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param UserUpdated $event
     *
     * @return void
     */
    public function handle(UserUpdated $event): void
    {
        // activity('admin')->causedBy($event->user)->performedOn($event->asset)->log('Создан словарь');
    }
}
