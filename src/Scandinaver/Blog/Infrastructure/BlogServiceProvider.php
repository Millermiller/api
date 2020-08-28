<?php


namespace Scandinaver\Blog\Infrastructure;

use Illuminate\Support\ServiceProvider;
use Scandinaver\Blog\Domain\Contract\Repository\PostRepositoryInterface;
use Scandinaver\Blog\Domain\Model\Post;
use Scandinaver\Blog\Infrastructure\Persistence\Doctrine\PostRepository;

/**
 * Class BlogServiceProvider
 *
 * @package Scandinaver\Blog\Application
 */
class BlogServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind(PostRepositoryInterface::class, function () {
            return new PostRepository(
                $this->app['em'],
                $this->app['em']->getClassMetadata(Post::class)
            );
        }
        );

        $this->app->bind(
            'CategoriesHandlerInterface',
            'Scandinaver\Blog\Application\Handler\Query\CategoriesHandler'
        );

        $this->app->bind(
            'CategoryHandlerInterface',
            'Scandinaver\Blog\Application\Handler\Query\CategoryHandler'
        );

        $this->app->bind(
            'CommentHandlerInterface',
            'Scandinaver\Blog\Application\Handler\Query\CommentHandler'
        );

        $this->app->bind(
            'CommentsHandlerInterface',
            'Scandinaver\Blog\Application\Handler\Query\CommentsHandler'
        );

        $this->app->bind(
            'CreateCategoryHandlerInterface',
            'Scandinaver\Blog\Application\Handler\Command\CreateCategoryHandler'
        );

        $this->app->bind(
            'CreateCommentHandlerInterface',
            'Scandinaver\Blog\Application\Handler\Command\CreateCommentHandler'
        );

        $this->app->bind(
            'CreatePostHandlerInterface',
            'Scandinaver\Blog\Application\Handler\Command\CreatePostHandler'
        );

        $this->app->bind(
            'DeleteCategoryHandlerInterface',
            'Scandinaver\Blog\Application\Handler\Command\DeleteCategoryHandler'
        );

        $this->app->bind(
            'DeleteCommentHandlerInterface',
            'Scandinaver\Blog\Application\Handler\Command\DeleteCommentHandler'
        );

        $this->app->bind(
            'DeletePostHandlerInterface',
            'Scandinaver\Blog\Application\Handler\Command\DeletePostHandler'
        );

        $this->app->bind(
            'PostHandlerInterface',
            'Scandinaver\Blog\Application\Handler\Query\PostHandler'
        );

        $this->app->bind(
            'PostsHandlerInterface',
            'Scandinaver\Blog\Application\Handler\Query\PostsHandler'
        );

        $this->app->bind(
            'UpdateCategoryHandlerInterface',
            'Scandinaver\Blog\Application\Handler\Command\UpdateCategoryHandler'
        );

        $this->app->bind(
            'UpdateCommentHandlerInterface',
            'Scandinaver\Blog\Application\Handler\Command\UpdateCommentHandler'
        );

        $this->app->bind(
            'UpdatePostHandlerInterface',
            'Scandinaver\Blog\Application\Handler\Command\UpdatePostHandler'
        );
    }
}