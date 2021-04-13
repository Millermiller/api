<?php


namespace Scandinaver\Blog\Application\Handler\Query;

use League\Fractal\Resource\Item;
use Scandinaver\Blog\Domain\Contract\Query\CommentHandlerInterface;
use Scandinaver\Blog\Domain\Exception\CommentNotFoundException;
use Scandinaver\Blog\Domain\Services\CommentService;
use Scandinaver\Blog\UI\Query\CommentQuery;
use Scandinaver\Blog\UI\Resources\CommentTransformer;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\Query;

/**
 * Class CommentHandler
 *
 * @package Scandinaver\Blog\Application\Handler\Query
 */
class CommentHandler extends AbstractHandler implements CommentHandlerInterface
{
    private CommentService $service;

    public function __construct(CommentService $service)
    {
        parent::__construct();

        $this->service = $service;
    }

    /**
     * @param  CommentQuery|Query  $query
     *
     * @throws CommentNotFoundException
     */
    public function handle($query): void
    {
        $comment = $this->service->one($query->getId());

        $this->resource = new Item($comment, new CommentTransformer());
    }
} 