<?php


namespace Scandinaver\Blog\Infrastructure;

use Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Scandinaver\User\Domain\Model\User;


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
            return $user->isAdmin();
        });

        Gate::define('update-post', function (User $user, int $postId) {
            return $user->isAdmin();
        });

        Gate::define('delete-post', function (User $user, int $postId) {
            return $user->isAdmin();
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
            return $user->isAdmin();
        });

        Gate::define('update-category', function (User $user, int $id) {
            return $user->isAdmin();
        });

        Gate::define('delete-category', function (User $user, int $id) {
            return $user->isAdmin();
        });

        /* COMMENT */
        Gate::define('view-comments', function (?User $user) {
            return true;
        });

        Gate::define('show-comment', function (?User $user, int $id) {
            return true;
        });

        Gate::define('create-comment', function (User $user) {
            return $user->isAdmin();
        });

        Gate::define('update-comment', function (User $user, int $id) {
            return $user->isAdmin();
        });

        Gate::define('delete-comment', function (User $user, int $id) {
            return $user->isAdmin();
        });
    }
}