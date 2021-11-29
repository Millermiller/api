<?php


namespace Scandinaver\Blog\Application\Provider;

use Illuminate\Support\ServiceProvider;
use Scandinaver\Blog\Domain\Contract\Repository\CategoryRepositoryInterface;
use Scandinaver\Blog\Domain\Contract\Repository\CommentRepositoryInterface;
use Scandinaver\Blog\Domain\Contract\Repository\PostRepositoryInterface;
use Scandinaver\Blog\Domain\Entity\Category;
use Scandinaver\Blog\Domain\Entity\Comment;
use Scandinaver\Blog\Domain\Entity\Post;
use Scandinaver\Blog\Infrastructure\Persistence\Doctrine\Repository\CategoryRepository;
use Scandinaver\Blog\Infrastructure\Persistence\Doctrine\Repository\CommentRepository;
use Scandinaver\Blog\Infrastructure\Persistence\Doctrine\Repository\PostRepository;

/**
 * Class DoctrineServiceProvider
 *
 * @package Scandinaver\Blog\Application\Provider
 */
class DoctrineServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind(PostRepositoryInterface::class, function () {
            return new PostRepository($this->app['em'], $this->app['em']->getClassMetadata(Post::class));
        });

        $this->app->bind(CategoryRepositoryInterface::class, function () {
            return new CategoryRepository($this->app['em'], $this->app['em']->getClassMetadata(Category::class));
        });

        $this->app->bind(CommentRepositoryInterface::class, function () {
            return new CommentRepository($this->app['em'], $this->app['em']->getClassMetadata(Comment::class));
        });
    }
}