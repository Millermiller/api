<?php


namespace Scandinaver\Blog\Application\Handler\Query;

use League\Fractal\Resource\Collection;
use Scandinaver\Blog\Domain\Contract\Query\PostsHandlerInterface;
use Scandinaver\Blog\Domain\Services\BlogService;
use Scandinaver\Blog\UI\Query\PostsQuery;
use Scandinaver\Blog\UI\Resources\PostTransformer;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\Query;

/**
 * Class PostsHandler
 *
 * @package Scandinaver\Blog\Application\Handler\Query
 */
class PostsHandler extends AbstractHandler implements PostsHandlerInterface
{
    private BlogService $blogService;

    public function __construct(BlogService $blogService)
    {
        parent::__construct();

        $this->blogService = $blogService;
    }

    /**
     * @param  PostsQuery|Query  $query
     */
    public function handle($query): void
    {
        $posts = $this->blogService->all();

        $this->resource = new Collection($posts, new PostTransformer());
        $this->fractal->parseIncludes('comments');
    }
} 