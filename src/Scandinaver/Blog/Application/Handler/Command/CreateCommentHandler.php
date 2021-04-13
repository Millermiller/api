<?php


namespace Scandinaver\Blog\Application\Handler\Command;

use League\Fractal\Resource\Item;
use Scandinaver\Blog\Domain\Contract\Command\CreateCommentHandlerInterface;
use Scandinaver\Blog\Domain\Exception\PostNotFoundException;
use Scandinaver\Blog\Domain\Services\CommentService;
use Scandinaver\Blog\UI\Command\CreateCommentCommand;
use Scandinaver\Blog\UI\Resources\CommentTransformer;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\Command;

/**
 * Class CreateCommentHandler
 *
 * @package Scandinaver\Blog\Application\Handler\Command
 */
class CreateCommentHandler extends AbstractHandler implements CreateCommentHandlerInterface
{
    private CommentService $service;

    public function __construct(CommentService $service)
    {
        parent::__construct();

        $this->service = $service;
    }

    /**
     * @param  CreateCommentCommand|Command  $command
     *
     * @throws PostNotFoundException
     */
    public function handle($command): void
    {
        $comment = $this->service->create($command->getUser(), $command->getData());

        $this->resource = new Item($comment, new CommentTransformer());
    }
}