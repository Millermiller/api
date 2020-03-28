<?php


namespace Scandinaver\Blog\Application\Handlers;

use Scandinaver\Blog\Application\Query\CommentQuery;

/**
 * Class CommentHandler
 *
 * @package Scandinaver\Blog\Application\Handlers
 */
class CommentHandler implements CommentHandlerInterface
{
    public function __construct()
    {

    }

    /**
     * @param CommentQuery
     *
     * @inheritDoc
     */
    public function handle($query)
    {
        // TODO: Implement handle() method.
    }
} 