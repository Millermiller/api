<?php


namespace Scandinaver\Blog\Application\Handler\Command;

use League\Fractal\Resource\Item;
use Scandinaver\Blog\Domain\Exception\CategoryNotFoundException;
use Scandinaver\Blog\Domain\Exception\PostNotFoundException;
use Scandinaver\Blog\Domain\Service\BlogService;
use Scandinaver\Blog\UI\Command\UpdatePostCommand;
use Scandinaver\Blog\UI\Resources\PostTransformer;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\BaseCommandInterface;
use Scandinaver\User\Domain\Exception\UserNotFoundException;

/**
 * Class UpdatePostCommandHandler
 *
 * @package Scandinaver\Blog\Application\Handler
 */
class UpdatePostCommandHandler extends AbstractHandler
{

    private BlogService $blogService;

    public function __construct(BlogService $blogService)
    {
        parent::__construct();

        $this->blogService = $blogService;
    }

    /**
     * @param  UpdatePostCommand|BaseCommandInterface  $command
     *
     * @throws PostNotFoundException
     * @throws CategoryNotFoundException
     * @throws UserNotFoundException
     */
    public function handle(BaseCommandInterface $command): void
    {
        $post = $this->blogService->updatePost($command->getPostId(), $command->buildDTO());

        $this->fractal->parseIncludes('comments');

        $this->resource = new Item($post, new PostTransformer());
    }
} 