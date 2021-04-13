<?php


namespace Scandinaver\Blog\Application\Handler\Query;

use League\Fractal\Resource\Collection;
use Scandinaver\Blog\Domain\Contract\Query\CommentsHandlerInterface;
use Scandinaver\Blog\Domain\Services\CommentService;
use Scandinaver\Blog\UI\Query\CommentsQuery;
use Scandinaver\Blog\UI\Resources\CommentTransformer;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\Query;

/**
 * Class CommentsHandler
 *
 * @package Scandinaver\Blog\Application\Handler\Query
 */
class CommentsHandler extends AbstractHandler implements CommentsHandlerInterface
{
    private CommentService $service;

    public function __construct(CommentService $service)
    {
        parent::__construct();

        $this->service = $service;
    }

    /**
     * @param  CommentsQuery|Query  $query
     */
    public function handle($query): void
    {
        $comments = $this->service->all();

        $this->resource = new Collection($comments, new CommentTransformer());
    }
} 