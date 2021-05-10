<?php


namespace Scandinaver\Blog\Application\Handler\Command;

use League\Fractal\Resource\NullResource;
use Scandinaver\Blog\Domain\Exception\CommentNotFoundException;
use Scandinaver\Blog\Domain\Service\CommentService;
use Scandinaver\Blog\UI\Command\DeleteCommentCommand;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\BaseCommandInterface;

/**
 * Class DeleteCommentCommandHandler
 *
 * @package Scandinaver\Blog\Application\Handler\Command
 */
class DeleteCommentCommandHandler extends AbstractHandler
{

    private CommentService $service;

    public function __construct(CommentService $service)
    {
        parent::__construct();

        $this->service = $service;
    }

    /**
     * @param  DeleteCommentCommand|BaseCommandInterface  $command
     *
     * @throws CommentNotFoundException
     */
    public function handle(BaseCommandInterface $command): void
    {
        $this->service->delete($command->getCommentId());

        $this->resource = new NullResource();
    }
} 