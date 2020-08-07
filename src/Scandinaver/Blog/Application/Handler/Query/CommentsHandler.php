<?php


namespace Scandinaver\Blog\Application\Handler\Query;

use Scandinaver\Blog\Domain\Contract\Query\CommentsHandlerInterface;
use Scandinaver\Blog\UI\Query\CommentsQuery;

/**
 * Class CommentsHandler
 *
 * @package Scandinaver\Blog\Application\Handler\Query
 */
class CommentsHandler implements CommentsHandlerInterface
{
    public function __construct()
    {

    }

    /**
     * @param  CommentsQuery  $query
     */
    public function handle($query)
    {
        // TODO: Implement handle() method.
    }
} 