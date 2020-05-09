<?php


namespace Scandinaver\Blog\Application;

use Illuminate\Support\ServiceProvider;
use Scandinaver\Blog\Domain\Contracts\PostRepositoryInterface;
use Scandinaver\Blog\Domain\Post;
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
        });

        $this->app->bind(
            'CategoriesHandlerInterface',
            'Scandinaver\Blog\Application\Handlers\CategoriesHandler'
        );

        $this->app->bind(
            'CategoryHandlerInterface',
            'Scandinaver\Blog\Application\Handlers\CategoryHandler'
        );

        $this->app->bind(
            'CommentHandlerInterface',
            'Scandinaver\Blog\Application\Handlers\CommentHandler'
        );

        $this->app->bind(
            'CommentsHandlerInterface',
            'Scandinaver\Blog\Application\Handlers\CommentsHandler'
        );

        $this->app->bind(
            'CreateCategoryHandlerInterface',
            'Scandinaver\Blog\Application\Handlers\CreateCategoryHandler'
        );

        $this->app->bind(
            'CreateCommentHandlerInterface',
            'Scandinaver\Blog\Application\Handlers\CreateCommentHandler'
        );

        $this->app->bind(
            'CreatePostHandlerInterface',
            'Scandinaver\Blog\Application\Handlers\CreatePostHandler'
        );

        $this->app->bind(
            'DeleteCategoryHandlerInterface',
            'Scandinaver\Blog\Application\Handlers\DeleteCategoryHandler'
        );

        $this->app->bind(
            'DeleteCommentHandlerInterface',
            'Scandinaver\Blog\Application\Handlers\DeleteCommentHandler'
        );

        $this->app->bind(
            'DeletePostHandlerInterface',
            'Scandinaver\Blog\Application\Handlers\DeletePostHandler'
        );

        $this->app->bind(
            'PostHandlerInterface',
            'Scandinaver\Blog\Application\Handlers\PostHandler'
        );

        $this->app->bind(
            'PostsHandlerInterface',
            'Scandinaver\Blog\Application\Handlers\PostsHandler'
        );

        $this->app->bind(
            'UpdateCategoryHandlerInterface',
            'Scandinaver\Blog\Application\Handlers\UpdateCategoryHandler'
        );

        $this->app->bind(
            'UpdateCommentHandlerInterface',
            'Scandinaver\Blog\Application\Handlers\UpdateCommentHandler'
        );

        $this->app->bind(
            'UpdatePostHandlerInterface',
            'Scandinaver\Blog\Application\Handlers\UpdatePostHandler'
        );
    }
}