<?php


namespace Scandinaver\Blog\Application\Providers;

use Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Scandinaver\Blog\Domain\Permissions\Category;
use Scandinaver\Blog\Domain\Permissions\Comment;
use Scandinaver\Blog\Domain\Permissions\Post;
use Scandinaver\Common\Domain\Contract\UserInterface;

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
        Gate::define(Post::VIEW, fn(?UserInterface $user): bool => $user === NULL || $user->can(Post::VIEW));

        Gate::define(Post::SHOW, fn(?UserInterface $user, int $postId): bool => $user === NULL || $user->can(Post::SHOW));

        Gate::define(Post::CREATE, fn(UserInterface $user): bool => $user->can(Post::CREATE));

        Gate::define(Post::UPDATE, fn(UserInterface $user, int $postId): bool => TRUE);

        Gate::define(Post::DELETE, fn(UserInterface $user, int $postId): bool => TRUE);

        Gate::define('upload-post', fn(UserInterface $user, int $postId) => TRUE);

        /* CATEGORY */
        Gate::define(Category::VIEW, fn(?UserInterface $user) => TRUE);

        Gate::define(Category::SHOW, fn(?UserInterface $user, int $id) => TRUE);

        Gate::define(Category::CREATE, fn(UserInterface $user) => TRUE);

        Gate::define(Category::UPDATE, fn(UserInterface $user, int $id) => TRUE);

        Gate::define(Category::DELETE, fn(UserInterface $user, int $id) => TRUE);

        /* COMMENT */
        Gate::define(Comment::VIEW, fn(?UserInterface $user) => TRUE);

        Gate::define(Comment::SHOW, fn(?UserInterface $user, int $id) => TRUE);

        Gate::define(Comment::CREATE, fn(UserInterface $user) => TRUE);

        Gate::define(Comment::UPDATE, fn(UserInterface $user, int $id) => TRUE);

        Gate::define(Comment::DELETE, fn(UserInterface $user, int $id) => TRUE);
    }
}