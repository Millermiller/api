<?php


namespace Scandinaver\Blog\Application\Handler\Command;

use League\Fractal\Resource\Item;
use Scandinaver\Blog\Domain\Exception\CategoryNotFoundException;
use Scandinaver\Blog\Domain\Exception\PostNotFoundException;
use Scandinaver\Blog\Domain\Service\BlogService;
use Scandinaver\Blog\UI\Command\UpdatePostCommand;
use Scandinaver\Blog\UI\Resources\PostTransformer;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\CommandInterface;
use Scandinaver\User\Domain\Exception\UserNotFoundException;

/**
 * Class UpdatePostCommandHandler
 *
 * @package Scandinaver\Blog\Application\Handler
 */
class UpdatePostCommandHandler extends AbstractHandler
{

    public function __construct(private BlogService $blogService)
    {
        parent::__construct();
    }

    /**
     * @throws PostNotFoundException
     * @throws CategoryNotFoundException
     * @throws UserNotFoundException
     */
    public function handle(CommandInterface|UpdatePostCommand $command): void
    {
        $post = $this->blogService->updatePost($command->getPostId(), $command->buildDTO());

        $this->fractal->parseIncludes('comments');

        $this->resource = new Item($post, new PostTransformer());
    }
} 