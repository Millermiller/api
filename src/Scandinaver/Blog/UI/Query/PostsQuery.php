<?php


namespace Scandinaver\Blog\UI\Query;

use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class PostsQuery
 *
 * @package Scandinaver\Blog\UI\Query
 *
 * @see     \Scandinaver\Blog\Application\Handler\Query\PostsQueryHandler
 */
class PostsQuery implements CommandInterface
{
    public function __construct()
    {
    }
}