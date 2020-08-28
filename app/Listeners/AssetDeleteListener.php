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
    public function __construct()
    {
        //
    }

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
