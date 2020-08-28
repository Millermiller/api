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
    public function __construct()
    {
        //
    }

    public function handle(UserUpdated $event): void
    {
        // activity('admin')->causedBy($event->user)->performedOn($event->asset)->log('Создан словарь');
    }
}
