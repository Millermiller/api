<?php


namespace Scandinaver\Blog\Application\Handler\Command;

use Scandinaver\Blog\Domain\Contract\Command\UpdateCommentHandlerInterface;
use Scandinaver\Blog\UI\Command\UpdateCommentCommand;

/**
 * Class UpdateCommentHandler
 *
 * @package Scandinaver\Blog\Application\Handler
 */
class UpdateCommentHandler implements UpdateCommentHandlerInterface
{
    public function __construct()
    {

    }

    /**
     * @param  UpdateCommentCommand
     *
     * @inheritDoc
     */
    public function handle($command): void
    {
        // TODO: Implement handle() method.
    }
} 