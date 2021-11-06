<?php


namespace Scandinaver\Blog\Application\Handler\Query;

use League\Fractal\Resource\Collection;
use Scandinaver\Blog\Domain\Service\BlogService;
use Scandinaver\Blog\UI\Query\PostsQuery;
use Scandinaver\Blog\UI\Resources\PostTransformer;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\BaseCommandInterface;

/**
 * Class PostsQueryHandler
 *
 * @package Scandinaver\Blog\Application\Handler\Query
 */
class PostsQueryHandler extends AbstractHandler
{

    private BlogService $blogService;

    public function __construct(BlogService $blogService)
    {
        parent::__construct();

        $this->blogService = $blogService;
    }

    /**
     * @param  PostsQuery|BaseCommandInterface  $query
     */
    public function handle(BaseCommandInterface $query): void
    {
        $posts = $this->blogService->all();

        $this->resource = new Collection($posts, new PostTransformer());
        $this->fractal->parseIncludes('comments');
    }
} 