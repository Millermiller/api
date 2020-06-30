<?php


namespace App\Listeners;

use App\Events\AssetCreated;
use App\Helpers\EloquentHelper;
use Scandinaver\Learn\Infrastructure\Persistence\Eloquent\Asset;
use Scandinaver\User\Infrastructure\Persistence\Eloquent\User;

/**
 * Class AssetCreatedListener
 *
 * @package App\Listeners
 */
class AssetCreatedListener
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
     * @param AssetCreated $event
     *
     * @return void
     */
    public function handle(AssetCreated $event): void
    {
        //$user  = User::find($event->user->getId())->first();
        //$asset = Asset::find($event->asset->getId())->first();

        //activity('public')
        //    ->causedBy($user)
        //    ->withProperties(['lang' => config('app.lang')])
        //    ->performedOn($asset)
        //    ->log('Создан словарь');
    }
}
