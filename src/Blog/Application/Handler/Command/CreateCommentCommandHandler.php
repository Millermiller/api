<?php


namespace Scandinaver\Blog\Application\Handler\Command;

use League\Fractal\Resource\Item;
use Scandinaver\Blog\Domain\Exception\PostNotFoundException;
use Scandinaver\Blog\Domain\Service\CommentService;
use Scandinaver\Blog\UI\Command\CreateCommentCommand;
use Scandinaver\Blog\UI\Resources\CommentTransformer;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\CommandInterface;
use Scandinaver\User\Domain\Exception\UserNotFoundException;

/**
 * Class CreateCommentCommandHandler
 *
 * @package Scandinaver\Blog\Application\Handler\Command
 */
class CreateCommentCommandHandler extends AbstractHandler
{

    public function __construct(private CommentService $service)
    {
        parent::__construct();
    }

    /**
     * @param  CreateCommentCommand  $command
     *
     * @throws PostNotFoundException|UserNotFoundException
     */
    public function handle(CommandInterface $command): void
    {
        $comment = $this->service->create($command->buildDTO());

        $this->resource = new Item($comment, new CommentTransformer());
    }
}