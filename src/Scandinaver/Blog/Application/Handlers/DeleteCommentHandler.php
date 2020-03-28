<?php


namespace Scandinaver\Blog\Application\Handlers;

use Scandinaver\Blog\Application\Commands\DeleteCommentCommand;

/**
 * Class DeleteCommentHandler
 *
 * @package Scandinaver\Blog\Application\Handlers
 */
class DeleteCommentHandler implements DeleteCommentHandlerInterface
{
    public function __construct()
    {

    }

    /**
     * @param DeleteCommentCommand
     *
     * @inheritDoc
     */
    public function handle($command): void
    {
        // TODO: Implement handle() method.
    }
} 