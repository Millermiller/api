<?php


namespace Scandinaver\Blog\Application\Query;

use Scandinaver\Shared\Contracts\Query;

/**
 * Class CategoryQuery
 *
 * @package Scandinaver\Blog\Application\Query
 * @see     \Scandinaver\Blog\Application\Handlers\CategoryHandler
 */
class CategoryQuery implements Query
{
    /**
     * @var integer
     */
    private $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
}