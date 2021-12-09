<?php


namespace Scandinaver\Blog\Application\Handler\Query;

use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Resource\Collection;
use Scandinaver\Blog\Domain\Service\CommentService;
use Scandinaver\Blog\UI\Query\CommentsQuery;
use Scandinaver\Blog\UI\Resources\CommentTransformer;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\BaseCommandInterface;

/**
 * Class CommentsQueryHandler
 *
 * @package Scandinaver\Blog\Application\Handler\Query
 */
class CommentsQueryHandler extends AbstractHandler
{

    public function __construct(private CommentService $service)
    {
        parent::__construct();
    }

    public function handle(BaseCommandInterface|CommentsQuery $query): void
    {
        $data = $this->service->all($query->getParameters());

        $this->resource = new Collection($data->items(), new CommentTransformer());

        $this->resource->setPaginator(new IlluminatePaginatorAdapter($data));
    }
} 