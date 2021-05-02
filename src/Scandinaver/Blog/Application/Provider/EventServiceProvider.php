<?php


namespace Scandinaver\Blog\Application\Provider;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

/**
 * Class EventServiceProvider
 *
 * @package Scandinaver\Blog\Application\Provider
 *
 * THIS CLASS IS AUTOGENERATED. DONT CHANGE IT MANUALLY.
 */
class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        'Scandinaver\Blog\Domain\Event\CategoryDeleted'     => [
            'Scandinaver\Blog\Domain\Event\Listener\CategoryDeletedListener',
        ],
        'Scandinaver\Blog\Domain\Event\CategoryNameUpdated' => [
            'Scandinaver\Blog\Domain\Event\Listener\CategoryNameUpdatedListener',
        ],
        'Scandinaver\Blog\Domain\Event\CommentAdded'        => [
            'Scandinaver\Blog\Domain\Event\Listener\CommentAddedListener',
        ],
    ];

    public function boot()
    {
        parent::boot();
    }
}