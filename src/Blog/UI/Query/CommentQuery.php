<?php


namespace Scandinaver\Blog\UI\Query;

use Scandinaver\Blog\Application\Handler\Query\CommentQueryHandler;
use Scandinaver\Core\Domain\Attribute\Handler;
use Scandinaver\Core\Domain\Contract\QueryInterface;

/**
 * Class CommentQuery
 *
 * @package Scandinaver\Blog\UI\Query
 */
#[Handler(CommentQueryHandler::class)]
class CommentQuery implements QueryInterface
{

    public function __construct(private int $id)
    {
    }

    public function getId(): int
    {
        return $this->id;
    }
}