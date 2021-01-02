<?php


namespace Scandinaver\Blog\Application\Handler\Query;

use Scandinaver\Blog\Domain\Contract\Query\CommentsHandlerInterface;
use Scandinaver\Blog\Domain\Services\CommentService;
use Scandinaver\Blog\UI\Query\CommentsQuery;
use Scandinaver\Shared\Contract\Query;

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
     * @param CommentsQuery|Query $query
     *
     * @return array
     */
    public function handle($query): array
    {
        return $this->service->getAll();
    }
} 