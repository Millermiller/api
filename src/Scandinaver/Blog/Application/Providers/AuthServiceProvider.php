<?php


namespace Scandinaver\Blog\Application\Providers;

use Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Scandinaver\Blog\Domain\Permissions\Category;
use Scandinaver\Blog\Domain\Permissions\Comment;
use Scandinaver\Blog\Domain\Permissions\Post;
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
        Gate::define(Post::VIEW, function (?User $user) {
            return TRUE;
        });

        Gate::define(Post::SHOW, function (?User $user, int $postId) {
            return TRUE;
        });

        Gate::define(Post::CREATE, function (User $user) {
            return $user->can(Post::CREATE);
        });

        Gate::define(Post::UPDATE, function (User $user, int $postId) {
            return TRUE;
        });

        Gate::define(Post::DELETE, function (User $user, int $postId) {
            return TRUE;
        });

        Gate::define('upload-post', function (User $user, int $postId) {
            return TRUE;
        });

        /* CATEGORY */
        Gate::define(Category::VIEW, function (?User $user) {
            return TRUE;
        });

        Gate::define(Category::SHOW, function (?User $user, int $id) {
            return TRUE;
        });

        Gate::define(Category::CREATE, function (User $user) {
            return TRUE;
        });

        Gate::define(Category::UPDATE, function (User $user, int $id) {
            return TRUE;
        });

        Gate::define(Category::DELETE, function (User $user, int $id) {
            return TRUE;
        });

        /* COMMENT */
        Gate::define(Comment::VIEW, function (?User $user) {
            return TRUE;
        });

        Gate::define(Comment::SHOW, function (?User $user, int $id) {
            return TRUE;
        });

        Gate::define(Comment::CREATE, function (User $user) {
            return TRUE;
        });

        Gate::define(Comment::UPDATE, function (User $user, int $id) {
            return TRUE;
        });

        Gate::define(Comment::DELETE, function (User $user, int $id) {
            return TRUE;
        });
    }
}