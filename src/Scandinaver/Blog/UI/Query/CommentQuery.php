<?php


namespace Scandinaver\Blog\UI\Query;

use Scandinaver\Shared\Contract\QueryInterface;

/**
 * Class CommentQuery
 *
 * @package Scandinaver\Blog\UI\Query
 *
 * @see     \Scandinaver\Blog\Application\Handler\Query\CommentQueryHandler
 */
class CommentQuery implements QueryInterface
{

    private int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }
}