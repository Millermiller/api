<?php


namespace Scandinaver\Blog\Application\Handler\Query;

use League\Fractal\Resource\Item;
use Scandinaver\Blog\Domain\Exception\CommentNotFoundException;
use Scandinaver\Blog\Domain\Service\CommentService;
use Scandinaver\Blog\UI\Query\CommentQuery;
use Scandinaver\Blog\UI\Resources\CommentTransformer;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\BaseCommandInterface;

/**
 * Class CommentQueryHandler
 *
 * @package Scandinaver\Blog\Application\Handler\Query
 */
class CommentQueryHandler extends AbstractHandler
{

    public function __construct(private CommentService $service)
    {
        parent::__construct();
    }

    /**
     * @throws CommentNotFoundException
     */
    public function handle(BaseCommandInterface|CommentQuery $query): void
    {
        $comment = $this->service->one($query->getId());

        $this->resource = new Item($comment, new CommentTransformer());
    }
} 