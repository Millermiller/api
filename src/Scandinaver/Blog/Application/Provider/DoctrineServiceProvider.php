<?php


namespace Scandinaver\Blog\Application\Provider;

use Doctrine\ORM\EntityManager;
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
        /** @var EntityManager $em */
        $em = app('em');

        $this->app->bind(PostRepositoryInterface::class,
            fn() => new PostRepository($em, $em->getClassMetadata(Post::class))
        );

        $this->app->bind(CategoryRepositoryInterface::class,
            fn() => new CategoryRepository($em, $em->getClassMetadata(Category::class))
        );

        $this->app->bind(CommentRepositoryInterface::class,
            fn() => new CommentRepository($em, $em->getClassMetadata(Comment::class))
        );
    }
}