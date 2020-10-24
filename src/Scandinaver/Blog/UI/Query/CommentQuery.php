<?php


namespace Scandinaver\Blog\UI\Query;

use Scandinaver\Shared\Contract\Query;

/**
 * Class CommentQuery
 *
 * @see     \Scandinaver\Blog\Application\Handler\Query\CommentHandler
 * @package Scandinaver\Blog\UI\Query
 */
class CommentQuery implements Query
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