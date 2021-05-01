<?php


namespace Scandinaver\Blog\UI\Query;

use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class CategoryQuery
 *
 * @package Scandinaver\Blog\UI\Query
 *
 * @see     \Scandinaver\Blog\Application\Handler\Query\CategoryHandler
 */
class CategoryQuery implements CommandInterface
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