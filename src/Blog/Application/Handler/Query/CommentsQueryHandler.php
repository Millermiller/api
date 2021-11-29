<?php


namespace Scandinaver\Blog\Application\Handler\Query;

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

    /**
     * @param  CommentsQuery  $query
     */
    public function handle(BaseCommandInterface $query): void
    {
        $comments = $this->service->all();

        $this->resource = new Collection($comments, new CommentTransformer());
    }
} 