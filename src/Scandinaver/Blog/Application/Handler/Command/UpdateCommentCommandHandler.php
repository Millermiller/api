<?php


namespace Scandinaver\Blog\Application\Handler\Command;

use League\Fractal\Resource\Item;
use Scandinaver\Blog\Domain\Exception\CommentNotFoundException;
use Scandinaver\Blog\Domain\Service\CommentService;
use Scandinaver\Blog\UI\Command\UpdateCommentCommand;
use Scandinaver\Blog\UI\Resources\CommentTransformer;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\BaseCommandInterface;

/**
 * Class UpdateCommentCommandHandler
 *
 * @package Scandinaver\Blog\Application\Handler
 */
class UpdateCommentCommandHandler extends AbstractHandler
{

    private CommentService $service;

    public function __construct(CommentService $service)
    {
        parent::__construct();

        $this->service = $service;
    }

    /**
     * @param  UpdateCommentCommand|BaseCommandInterface  $command
     *
     * @throws CommentNotFoundException
     */
    public function handle(BaseCommandInterface $command): void
    {
        $comment = $this->service->update($command->getCommentId(), $command->buildDTO());

        $this->resource = new Item($comment, new CommentTransformer());
    }
} 