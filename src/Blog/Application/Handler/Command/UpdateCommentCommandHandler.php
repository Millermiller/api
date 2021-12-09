<?php


namespace Scandinaver\Blog\Application\Handler\Command;

use League\Fractal\Resource\Item;
use Scandinaver\Blog\Domain\Exception\CommentNotFoundException;
use Scandinaver\Blog\Domain\Service\CommentService;
use Scandinaver\Blog\UI\Command\UpdateCommentCommand;
use Scandinaver\Blog\UI\Resources\CommentTransformer;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\CommandInterface;

/**
 * Class UpdateCommentCommandHandler
 *
 * @package Scandinaver\Blog\Application\Handler
 */
class UpdateCommentCommandHandler extends AbstractHandler
{

    public function __construct(private CommentService $service)
    {
        parent::__construct();
    }

    /**
     * @throws CommentNotFoundException
     */
    public function handle(CommandInterface|UpdateCommentCommand $command): void
    {
        $comment = $this->service->update($command->getCommentId(), $command->buildDTO());

        $this->resource = new Item($comment, new CommentTransformer());
    }
} 