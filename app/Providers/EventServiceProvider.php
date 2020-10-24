<?php


namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

/**
 * Class EventServiceProvider
 *
 * @package App\Providers
 */
class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\Event'            => [
            'App\Listeners\EventListener',
        ],
        'App\Events\UserRegistered'   => [
            'App\Listeners\UserRegisteredListener',
        ],
        'App\Events\UserUpdated'      => [
            'App\Listeners\UserUpdatedListener',
        ],
        'App\Events\UserDeleted'      => [
            'App\Listeners\UserDeletedListener',
        ],
        'App\Events\PasswordReset'    => [
            'App\Listeners\PasswordResetListener',
        ],
        'App\Events\UserPhotoUpdated' => [
            'App\Listeners\UserPhotoUpdatedListener',
        ],
        'App\Events\MessageEvent'     => [
            'App\Listeners\MessageEventListener',
        ],
        'App\Events\MessageRecieved'  => [
            'App\Listeners\MessageRecievedListener',
        ],
        'App\Events\NextLevel'        => [
            'App\Listeners\NextLevelListener',
        ],
        'App\Events\NextTextLevel'    => [
            'App\Listeners\NextTextLevelListener',
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
