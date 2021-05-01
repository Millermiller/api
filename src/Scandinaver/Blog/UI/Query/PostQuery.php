<?php


namespace Scandinaver\Blog\UI\Query;

use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class PostQuery
 *
 * @package Scandinaver\Blog\UI\Query
 *
 * @see     \Scandinaver\Blog\Application\Handler\Query\PostHandler
 */
class PostQuery implements CommandInterface
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