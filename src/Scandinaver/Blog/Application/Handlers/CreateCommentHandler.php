<?php


namespace Scandinaver\Blog\Application\Handlers;

use Scandinaver\Blog\Application\Commands\CreateCommentCommand;

/**
 * Class CreateCommentHandler
 * @package Scandinaver\Blog\Application\Handlers
 */
class CreateCommentHandler implements CreateCommentHandlerInterface
{
    public function __construct()
    {

    }

    /**
     * @param CreateCommentCommand
     * @inheritDoc
     */
    public function handle($command): void
    {
        // TODO: Implement handle() method.
    }
} 