<?php


namespace Scandinaver\Blog\Application\Handler\Query;

use Scandinaver\Blog\Domain\Contract\Query\CommentsHandlerInterface;
use Scandinaver\Blog\Domain\Services\CommentService;
use Scandinaver\Blog\UI\Query\CommentsQuery;

/**
 * Class CommentsHandler
 *
 * @package Scandinaver\Blog\Application\Handler\Query
 */
class CommentsHandler implements CommentsHandlerInterface
{

    private CommentService $service;

    public function __construct(CommentService $service)
    {
        $this->service = $service;
    }

    /**
     * @param  CommentsQuery  $query
     */
    public function handle($query)
    {
        return $this->service->getAll();
    }
} 