<?php


namespace Scandinaver\Blog\Application\Handler\Command;

use League\Fractal\Resource\Item;
use Scandinaver\Blog\Domain\Contract\Command\UpdateCommentHandlerInterface;
use Scandinaver\Blog\Domain\Exception\CommentNotFoundException;
use Scandinaver\Blog\Domain\Services\CommentService;
use Scandinaver\Blog\UI\Command\UpdateCommentCommand;
use Scandinaver\Blog\UI\Resources\CommentTransformer;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\Command;

/**
 * Class UpdateCommentHandler
 *
 * @package Scandinaver\Blog\Application\Handler
 */
class UpdateCommentHandler extends AbstractHandler implements UpdateCommentHandlerInterface
{
    private CommentService $service;

    public function __construct(CommentService $service)
    {
        parent::__construct();

        $this->service = $service;
    }

    /**
     * @param  UpdateCommentCommand|Command  $command
     *
     * @throws CommentNotFoundException
     */
    public function handle($command): void
    {
        $comment = $this->service->update($command->getCommentId(), $command->getData());

        $this->resource = new Item($comment, new CommentTransformer());
    }
} 