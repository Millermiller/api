<?php


namespace App\Listeners;

use App\Events\AssetDelete;

/**
 * Class AssetDeleteListener
 *
 * @package App\Listeners
 */
class AssetDeleteListener
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
     * @param AssetDelete $event
     *
     * @return void
     */
    public function handle(AssetDelete $event): void
    {
        /*
        activity('public')
            ->causedBy($event->user)
            ->performedOn($event->asset)
            ->withProperties(['lang' => config('app.lang')])
            ->log('Словарь удален');
         **/
    }
}
