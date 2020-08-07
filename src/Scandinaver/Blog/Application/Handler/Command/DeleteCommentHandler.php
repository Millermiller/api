<?php


namespace Scandinaver\Blog\Application\Handler\Command;

use Scandinaver\Blog\Domain\Contract\Command\DeleteCommentHandlerInterface;
use Scandinaver\Blog\UI\Command\DeleteCommentCommand;

/**
 * Class DeleteCommentHandler
 *
 * @package Scandinaver\Blog\Application\Handler\Command
 */
class DeleteCommentHandler implements DeleteCommentHandlerInterface
{
    public function __construct()
    {

    }

    /**
     * @param  DeleteCommentCommand
     *
     * @inheritDoc
     */
    public function handle($command): void
    {
        // TODO: Implement handle() method.
    }
} 