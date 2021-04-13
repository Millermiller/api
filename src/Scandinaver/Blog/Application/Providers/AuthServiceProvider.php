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
        Gate::define(Post::VIEW, fn(?User $user): bool => $user === NULL || $user->can(Post::VIEW));

        Gate::define(Post::SHOW, fn(?User $user, int $postId): bool => $user === NULL || $user->can(Post::SHOW));

        Gate::define(Post::CREATE, fn(User $user): bool => $user->can(Post::CREATE));

        Gate::define(Post::UPDATE, fn(User $user, int $postId): bool => TRUE);

        Gate::define(Post::DELETE, fn(User $user, int $postId): bool => TRUE);

        Gate::define('upload-post', fn(User $user, int $postId) => TRUE);

        /* CATEGORY */
        Gate::define(Category::VIEW, fn(?User $user) => TRUE);

        Gate::define(Category::SHOW, fn(?User $user, int $id) => TRUE);

        Gate::define(Category::CREATE, fn(User $user) => TRUE);

        Gate::define(Category::UPDATE, fn(User $user, int $id) => TRUE);

        Gate::define(Category::DELETE, fn(User $user, int $id) => TRUE);

        /* COMMENT */
        Gate::define(Comment::VIEW, fn(?User $user) => TRUE);

        Gate::define(Comment::SHOW, fn(?User $user, int $id) => TRUE);

        Gate::define(Comment::CREATE, fn(User $user) => TRUE);

        Gate::define(Comment::UPDATE, fn(User $user, int $id) => TRUE);

        Gate::define(Comment::DELETE, fn(User $user, int $id) => TRUE);
    }
}