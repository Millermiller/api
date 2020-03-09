<?php


namespace Scandinaver\Blog\Application\Handlers;

use Scandinaver\Blog\Application\Query\CommentsQuery;

/**
 * Class CommentsHandler
 * @package Scandinaver\Blog\Application\Handlers
 */
class CommentsHandler implements CommentsHandlerInterface
{
    public function __construct()
    {

    }

    /**
     * @param CommentsQuery
     * @inheritDoc
     */
    public function handle($query)
    {
        // TODO: Implement handle() method.
    }
} 