<?php


namespace Scandinaver\Blog\Application\Handler\Query;

use League\Fractal\Resource\Collection;
use Scandinaver\Blog\Domain\Service\BlogService;
use Scandinaver\Blog\UI\Query\PostsQuery;
use Scandinaver\Blog\UI\Resources\PostTransformer;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\BaseCommandInterface;

/**
 * Class PostsQueryHandler
 *
 * @package Scandinaver\Blog\Application\Handler\Query
 */
class PostsQueryHandler extends AbstractHandler
{

    public function __construct(private BlogService $service)
    {
        parent::__construct();
    }

    /**
     * @param  PostsQuery $query
     */
    public function handle(BaseCommandInterface $query): void
    {
        $posts = $this->service->all();

        $this->fractal->parseIncludes('comments');

        $this->resource = new Collection($posts, new PostTransformer(), 'post');
    }
} 