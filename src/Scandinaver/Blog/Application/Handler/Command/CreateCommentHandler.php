<?php


namespace Scandinaver\Blog\Application\Handler\Command;

use Scandinaver\Blog\Domain\Contract\Command\CreateCommentHandlerInterface;
use Scandinaver\Blog\UI\Command\CreateCommentCommand;

/**
 * Class CreateCommentHandler
 *
 * @package Scandinaver\Blog\Application\Handler\Command
 */
class CreateCommentHandler implements CreateCommentHandlerInterface
{

    public function __construct()
    {

    }

    /**
     * @param  CreateCommentCommand
     *
     * @inheritDoc
     */
    public function handle($command): void
    {
        // TODO: Implement handle() method.
    }
}