<?php


namespace Scandinaver\Blog\Application\Handler\Query;

use Doctrine\ORM\Query\QueryException;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
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
     * @param  PostsQuery  $query
     *
     * @throws QueryException
     */
    public function handle(BaseCommandInterface $query): void
    {
        $data = $this->service->all($query->getParameters());

        $this->fractal->parseIncludes('comments');

        $this->resource = new Collection($data->items(), new PostTransformer(), 'post');

        $this->resource->setPaginator(new IlluminatePaginatorAdapter($data));
    }
} 