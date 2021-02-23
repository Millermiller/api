<?php


namespace Scandinaver\Blog\Application\Handler\Command;

use Scandinaver\Blog\Domain\Contract\Command\DeleteCommentHandlerInterface;
use Scandinaver\Blog\Domain\Exception\CommentNotFoundException;
use Scandinaver\Blog\Domain\Services\CommentService;
use Scandinaver\Blog\UI\Command\DeleteCommentCommand;
use Scandinaver\Shared\Contract\Command;

/**
 * Class DeleteCommentHandler
 *
 * @package Scandinaver\Blog\Application\Handler\Command
 */
class DeleteCommentHandler implements DeleteCommentHandlerInterface
{

    private CommentService $service;

    public function __construct(CommentService $service)
    {
        $this->service = $service;
    }

    /**
     * @param  DeleteCommentCommand|Command  $command
     *
     * @throws CommentNotFoundException
     */
    public function handle($command): void
    {
        $this->service->delete($command->getCommentId());
    }
} 