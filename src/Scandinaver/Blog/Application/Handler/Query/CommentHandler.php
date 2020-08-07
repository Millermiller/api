<?php


namespace Scandinaver\Blog\Application\Handler\Query;

use Scandinaver\Blog\Domain\Contract\Query\CommentHandlerInterface;
use Scandinaver\Blog\UI\Query\CommentQuery;

/**
 * Class CommentHandler
 *
 * @package Scandinaver\Blog\Application\Handler\Query
 */
class CommentHandler implements CommentHandlerInterface
{
    public function __construct()
    {

    }

    /**
     * @param  CommentQuery  $query
     *
     */
    public function handle($query)
    {
        // TODO: Implement handle() method.
    }
} 