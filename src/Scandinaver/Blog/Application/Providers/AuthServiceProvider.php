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
            return true;
        });

        Gate::define(Post::SHOW, function (?User $user, int $postId) {
            return true;
        });

        Gate::define(Post::CREATE, function (User $user) {
            return $user->can(Post::CREATE);
        });

        Gate::define(Post::UPDATE, function (User $user, int $postId) {
            return true;
        });

        Gate::define(Post::DELETE, function (User $user, int $postId) {
            return true;
        });

        Gate::define('upload-post', function (User $user, int $postId) {
            return true;
        });

        /* CATEGORY */
        Gate::define(Category::VIEW, function (?User $user) {
            return true;
        });

        Gate::define(Category::SHOW, function (?User $user, int $id) {
            return true;
        });

        Gate::define(Category::CREATE, function (User $user) {
            return true;
        });

        Gate::define(Category::UPDATE, function (User $user, int $id) {
            return true;
        });

        Gate::define(Category::DELETE, function (User $user, int $id) {
            return true;
        });

        /* COMMENT */
        Gate::define(Comment::VIEW, function (?User $user) {
            return true;
        });

        Gate::define(Comment::SHOW, function (?User $user, int $id) {
            return true;
        });

        Gate::define(Comment::CREATE, function (User $user) {
            return true;
        });

        Gate::define(Comment::UPDATE, function (User $user, int $id) {
            return true;
        });

        Gate::define(Comment::DELETE, function (User $user, int $id) {
            return true;
        });
    }
}