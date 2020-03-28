<?php


namespace Scandinaver\Blog\Application\Query;

use Scandinaver\Shared\Contracts\Query;

/**
 * Class PostQuery
 * @package Scandinaver\Blog\Application\Query
 *
 * @see \Scandinaver\Blog\Application\Handlers\PostHandler
 */
class PostQuery implements Query
{
    /**
     * @var int
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