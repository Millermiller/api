<?php


namespace Scandinaver\Blog\UI\Query;

use Scandinaver\Shared\Contract\Query;

/**
 * Class CategoryQuery
 *
 * @see     \Scandinaver\Blog\Application\Handler\Query\CategoryHandler
 * @package Scandinaver\Blog\UI\Query
 */
class CategoryQuery implements Query
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