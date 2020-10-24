<?php


namespace Scandinaver\Blog\Infrastructure;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

/**
 * Class EventServiceProvider
 *
 * @package Scandinaver\Blog\Infrastructure
 */
class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        'Scandinaver\Blog\Domain\Events\CategoryNameUpdated' => [
            'Scandinaver\Blog\Domain\Events\Listeners\CategoryNameUpdatedListener',
        ],
        'Scandinaver\Blog\Domain\Events\CommentAdded' => [
            'Scandinaver\Blog\Domain\Events\Listeners\CommentAddedListener',
        ],
        'Scandinaver\Blog\Domain\Events\CategoryDeleted' => [
            'Scandinaver\Blog\Domain\Events\Listeners\CategoryDeletedListener',
        ],
    ];

    public function boot()
    {
        parent::boot();
    }
}