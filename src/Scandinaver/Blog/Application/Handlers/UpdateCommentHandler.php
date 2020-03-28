<?php


namespace Scandinaver\Blog\Application\Handlers;

use Scandinaver\Blog\Application\Commands\UpdateCommentCommand;

/**
 * Class UpdateCommentHandler
 *
 * @package Scandinaver\Blog\Application\Handlers
 */
class UpdateCommentHandler implements UpdateCommentHandlerInterface
{
    public function __construct()
    {

    }

    /**
     * @param UpdateCommentCommand
     *
     * @inheritDoc
     */
    public function handle($command): void
    {
        // TODO: Implement handle() method.
    }
} 