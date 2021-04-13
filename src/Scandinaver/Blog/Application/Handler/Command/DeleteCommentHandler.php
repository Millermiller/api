<?php


namespace Scandinaver\Blog\Application\Handler\Command;

use League\Fractal\Resource\NullResource;
use Scandinaver\Blog\Domain\Contract\Command\DeleteCommentHandlerInterface;
use Scandinaver\Blog\Domain\Exception\CommentNotFoundException;
use Scandinaver\Blog\Domain\Services\CommentService;
use Scandinaver\Blog\UI\Command\DeleteCommentCommand;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\Command;

/**
 * Class DeleteCommentHandler
 *
 * @package Scandinaver\Blog\Application\Handler\Command
 */
class DeleteCommentHandler extends AbstractHandler implements DeleteCommentHandlerInterface
{
    private CommentService $service;

    public function __construct(CommentService $service)
    {
        parent::__construct();

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

        $this->resource = new NullResource();
    }
} 