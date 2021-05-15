<?php


namespace Scandinaver\Blog\Application\Provider;

use Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Scandinaver\Blog\Domain\Permission\Category;
use Scandinaver\Blog\Domain\Permission\Comment;
use Scandinaver\Blog\Domain\Permission\Post;
use Scandinaver\Common\Domain\Contract\UserInterface;
use Scandinaver\User\Domain\Model\User;

/**
 * Class AuthServiceProvider
 *
 * @package Scandinaver\Blog\Application\Provider
 */
class AuthServiceProvider extends ServiceProvider
{

    public function boot()
    {
        /* POST */
        Gate::define(Post::VIEW, fn(?UserInterface $user): bool => $user === NULL || $user->can(Post::VIEW));

        Gate::define(Post::SHOW,
            fn(?UserInterface $user, int $postId): bool => $user === NULL || $user->can(Post::SHOW));

        Gate::define(Post::CREATE, fn(UserInterface $user): bool => $user->can(Post::CREATE));

        Gate::define(Post::UPDATE, fn(UserInterface $user, int $postId): bool => $user->can(Post::UPDATE));

        Gate::define(Post::DELETE, fn(UserInterface $user, int $postId): bool => $user->can(Post::DELETE));

        Gate::define('upload-post', fn(UserInterface $user, int $postId) => TRUE);

        /* CATEGORY */
        Gate::define(Category::VIEW, fn(?UserInterface $user) => $user === NULL || $user->can(Category::VIEW));

        Gate::define(Category::SHOW, fn(?UserInterface $user, int $id) => $user->can(Category::SHOW));

        Gate::define(Category::CREATE, fn(UserInterface $user) => $user->can(Category::CREATE));

        Gate::define(Category::UPDATE, fn(UserInterface $user, int $id) => $user->can(Category::UPDATE));

        Gate::define(Category::DELETE, fn(UserInterface $user, int $id) => $user->can(Category::DELETE));

        /* COMMENT */
        Gate::define(Comment::VIEW, fn(?UserInterface $user) => $user === NULL || $user->can(Comment::VIEW));

        Gate::define(Comment::SHOW, fn(?UserInterface $user, int $id) => $user->can(Comment::SHOW));

        Gate::define(Comment::CREATE, fn(UserInterface $user) => $user->can(Comment::CREATE));

        Gate::define(Comment::UPDATE, fn(UserInterface $user, int $id) => $user->can(Comment::UPDATE));

        Gate::define(Comment::DELETE, fn(UserInterface $user, int $id) => $user->can(Comment::DELETE));
    }
}