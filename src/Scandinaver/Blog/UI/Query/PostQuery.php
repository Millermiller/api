<?php


namespace Scandinaver\Blog\UI\Query;

use Scandinaver\Shared\Contract\Query;

/**
 * Class PostQuery
 *
 * @see     \Scandinaver\Blog\Application\Handler\Query\PostHandler
 * @package Scandinaver\Blog\UI\Query
 */
class PostQuery implements Query
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