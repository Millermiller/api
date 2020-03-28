<?php


namespace App\Listeners;

use App\Events\UserUpdated;

/**
 * Class UserUpdatedListener
 *
 * @package App\Listeners
 */
class UserUpdatedListener
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
        //
    }
}
