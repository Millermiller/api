<?php


namespace Scandinaver\Blog\Application\Providers;

use Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Scandinaver\User\Domain\Model\User;

/**
 * Class AuthServiceProvider
 *
 * @package Scandinaver\Blog\Application\Providers
 */
class AuthServiceProvider extends ServiceProvider
{
    public function boot()
    {
        /* POST */
        Gate::define('view-posts', function (?User $user) {
            return true;
        });

        Gate::define('show-post', function (?User $user, int $postId) {
            return true;
        });

        Gate::define('create-post', function (User $user) {
            return true;
        });

        Gate::define('update-post', function (User $user, int $postId) {
            return true;
        });

        Gate::define('delete-post', function (User $user, int $postId) {
            return true;
        });

        Gate::define('upload-post', function (User $user, int $postId) {
            return true;
        });

        /* CATEGORY */
        Gate::define('view-categories', function (?User $user) {
            return true;
        });

        Gate::define('show-category', function (?User $user, int $id) {
            return true;
        });

        Gate::define('create-category', function (User $user) {
            return true;
        });

        Gate::define('update-category', function (User $user, int $id) {
            return true;
        });

        Gate::define('delete-category', function (User $user, int $id) {
            return true;
        });

        /* COMMENT */
        Gate::define('view-comments', function (?User $user) {
            return true;
        });

        Gate::define('show-comment', function (?User $user, int $id) {
            return true;
        });

        Gate::define('create-comment', function (User $user) {
            return true;
        });

        Gate::define('update-comment', function (User $user, int $id) {
            return true;
        });

        Gate::define('delete-comment', function (User $user, int $id) {
            return true;
        });
    }
}