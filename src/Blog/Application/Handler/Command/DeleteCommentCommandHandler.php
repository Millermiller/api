<?php


namespace Scandinaver\Blog\Application\Handler\Command;

use League\Fractal\Resource\NullResource;
use Scandinaver\Blog\Domain\Exception\CommentNotFoundException;
use Scandinaver\Blog\Domain\Service\CommentService;
use Scandinaver\Blog\UI\Command\DeleteCommentCommand;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\CommandInterface;

/**
 * Class DeleteCommentCommandHandler
 *
 * @package Scandinaver\Blog\Application\Handler\Command
 */
class DeleteCommentCommandHandler extends AbstractHandler
{

    public function __construct(private CommentService $service)
    {
        parent::__construct();
    }

    /**
     * @param  DeleteCommentCommand  $command
     *
     * @throws CommentNotFoundException
     */
    public function handle(CommandInterface $command): void
    {
        $this->service->delete($command->getCommentId());

        $this->resource = new NullResource();
    }
} 