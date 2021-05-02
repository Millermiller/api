<?php


namespace Scandinaver\Blog\Application\Handler\Query;

use League\Fractal\Resource\Collection;
use Scandinaver\Blog\Domain\Service\CommentService;
use Scandinaver\Blog\UI\Query\CommentsQuery;
use Scandinaver\Blog\UI\Resources\CommentTransformer;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class CommentsQueryHandler
 *
 * @package Scandinaver\Blog\Application\Handler\Query
 */
class CommentsQueryHandler extends AbstractHandler
{
    private CommentService $service;

    public function __construct(CommentService $service)
    {
        parent::__construct();

        $this->service = $service;
    }

    /**
     * @param  CommentsQuery|CommandInterface  $query
     */
    public function handle(CommandInterface $query): void
    {
        $comments = $this->service->all();

        $this->resource = new Collection($comments, new CommentTransformer());
    }
} 