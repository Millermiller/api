<?php


namespace Scandinaver\Blog\Application\Handler\Query;

use Scandinaver\Blog\Domain\Contract\Query\CommentHandlerInterface;
use Scandinaver\Blog\Domain\Exception\CommentNotFoundException;
use Scandinaver\Blog\Domain\Model\CommentDTO;
use Scandinaver\Blog\Domain\Services\CommentService;
use Scandinaver\Blog\UI\Query\CommentQuery;
use Scandinaver\Shared\Contract\Query;

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
     * @param  CommentQuery|Query  $query
     *
     * @return CommentDTO
     * @throws CommentNotFoundException
     */
    public function handle($query): CommentDTO
    {
        return $this->service->one($query->getId());
    }
} 