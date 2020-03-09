<?php


namespace Scandinaver\Blog\Application\Query;

use Scandinaver\Shared\Contracts\Query;

/**
 * Class CommentQuery
 * @package Scandinaver\Blog\Application\Query
 */
class CommentQuery implements Query
{
    /**
     * @var integer
     */
    private $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }
}