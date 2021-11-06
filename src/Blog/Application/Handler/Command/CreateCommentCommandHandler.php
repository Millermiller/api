<?php


namespace Scandinaver\Blog\Application\Handler\Command;

use League\Fractal\Resource\Item;
use Scandinaver\Blog\Domain\Exception\PostNotFoundException;
use Scandinaver\Blog\Domain\Service\CommentService;
use Scandinaver\Blog\UI\Command\CreateCommentCommand;
use Scandinaver\Blog\UI\Resources\CommentTransformer;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\BaseCommandInterface;
use Scandinaver\User\Domain\Exception\UserNotFoundException;

/**
 * Class CreateCommentCommandHandler
 *
 * @package Scandinaver\Blog\Application\Handler\Command
 */
class CreateCommentCommandHandler extends AbstractHandler
{

    private CommentService $service;

    public function __construct(CommentService $service)
    {
        parent::__construct();

        $this->service = $service;
    }

    /**
     * @param  CreateCommentCommand|BaseCommandInterface  $command
     *
     * @throws PostNotFoundException|UserNotFoundException
     */
    public function handle(BaseCommandInterface $command): void
    {
        $comment = $this->service->create($command->buildDTO());

        $this->resource = new Item($comment, new CommentTransformer());
    }
}