<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\Event' => [
            'App\Listeners\EventListener',
        ],
        'App\Events\UserRegistered' => [
            'App\Handlers\Events\UserRegisteredListener',
        ],
        'App\Events\UserUpdated' => [
            'App\Handlers\Events\UserUpdatedListener',
        ],
        'App\Events\UserPhotoUpdated' => [
            'App\Handlers\Events\UserPhotoUpdatedListener',
        ],
        'App\Events\MessageEvent' => [
            'App\Handlers\Events\MessageEventListener',
        ],
        'App\Events\MessageRecieved' => [
            'App\Handlers\Events\MessageRecievedListener',
        ],
        'App\Events\AssetCreated' => [
            'App\Handlers\Events\AssetCreatedListener',
        ],
        'App\Events\AssetDelete' => [
            'App\Handlers\Events\AssetDeleteListener',
        ],
        'App\Events\NextLevel' => [
            'App\Handlers\Events\NextLevelListener',
        ],
        'App\Events\NextTextLevel' => [
            'App\Handlers\Events\NextTextLevelListener',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
