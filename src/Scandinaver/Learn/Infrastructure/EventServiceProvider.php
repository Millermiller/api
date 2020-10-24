<?php


namespace Scandinaver\Learn\Infrastructure;

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
        'Scandinaver\Learn\Domain\Events\WordUpdated' => [
            'Scandinaver\Learn\Domain\Events\Listeners\WordUpdatedListener',
        ],
        'Scandinaver\Learn\Domain\Events\TranslateUpdated' => [
            'Scandinaver\Learn\Domain\Events\Listeners\TranslateUpdatedListener',
        ],
        'Scandinaver\Learn\Domain\Events\CardAddedToAsset' => [
            'Scandinaver\Learn\Domain\Events\Listeners\CardAddedToAssetListener',
        ],
        'Scandinaver\Learn\Domain\Events\CardRemovedFromAsset' => [
            'Scandinaver\Learn\Domain\Events\Listeners\CardRemovedFromAssetListener',
        ],
        'Scandinaver\Learn\Domain\Events\AssetCreated' => [
            'Scandinaver\Learn\Domain\Events\Listeners\AssetCreatedListener',
        ],
        'Scandinaver\Learn\Domain\Events\AssetDeleted' => [
            'Scandinaver\Learn\Domain\Events\Listeners\AssetDeletedListener',
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
