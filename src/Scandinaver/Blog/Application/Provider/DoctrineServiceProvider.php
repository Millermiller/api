<?php


namespace Scandinaver\Blog\Application\Provider;

use Illuminate\Support\ServiceProvider;
use Scandinaver\Blog\Domain\Contract\Repository\CategoryRepositoryInterface;
use Scandinaver\Blog\Domain\Contract\Repository\CommentRepositoryInterface;
use Scandinaver\Blog\Domain\Contract\Repository\PostRepositoryInterface;
use Scandinaver\Blog\Domain\Model\Category;
use Scandinaver\Blog\Domain\Model\Comment;
use Scandinaver\Blog\Domain\Model\Post;
use Scandinaver\Blog\Infrastructure\Persistence\Doctrine\CategoryRepository;
use Scandinaver\Blog\Infrastructure\Persistence\Doctrine\CommentRepository;
use Scandinaver\Blog\Infrastructure\Persistence\Doctrine\PostRepository;

/**
 * Class DoctrineServiceProvider
 *
 * @package Scandinaver\Blog\Application\Provider
 */
class DoctrineServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(PostRepositoryInterface::class,
            fn() => new PostRepository($this->app['em'], $this->app['em']->getClassMetadata(Post::class))
        );

        $this->app->bind(CategoryRepositoryInterface::class,
            fn() => new CategoryRepository($this->app['em'], $this->app['em']->getClassMetadata(Category::class))
        );

        $this->app->bind(CommentRepositoryInterface::class,
            fn() => new CommentRepository($this->app['em'], $this->app['em']->getClassMetadata(Comment::class))
        );
    }
}