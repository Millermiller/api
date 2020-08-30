<?php


namespace Scandinaver\Blog\Application\Handler\Query;

use Scandinaver\Blog\Domain\Contract\Query\CommentHandlerInterface;
use Scandinaver\Blog\Domain\Services\CommentService;
use Scandinaver\Blog\UI\Query\CommentQuery;

/**
 * Class CommentHandler
 *
 * @package Scandinaver\Blog\Application\Handler\Query
 */
class CommentHandler implements CommentHandlerInterface
{

    private CommentService $service;

    public function __construct(CommentService $service)
    {
        $this->service = $service;
    }

    /**
     * @param  CommentQuery  $query
     */
    public function handle($query)
    {
        return $this->service->getAll();
    }
} 