<?php


namespace Scandinaver\Blog\Application\Handler\Command;

use League\Fractal\Resource\Item;
use Scandinaver\Blog\Domain\Contract\Command\CreatePostHandlerInterface;
use Scandinaver\Blog\Domain\Services\BlogService;
use Scandinaver\Blog\UI\Command\CreatePostCommand;
use Scandinaver\Blog\UI\Resources\PostTransformer;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\Command;

/**
 * Class CreatePostHandler
 *
 * @package Scandinaver\Blog\Application\Handler\Command
 */
class CreatePostHandler extends AbstractHandler implements CreatePostHandlerInterface
{
    private BlogService $blogService;

    public function __construct(BlogService $blogService)
    {
        parent::__construct();

        $this->blogService = $blogService;
    }

    /**
     * @param  CreatePostCommand|Command  $command
     */
    public function handle($command): void
    {
        $post = $this->blogService->create($command->getUser(), $command->getData());

        $this->fractal->parseIncludes('comments');

        $this->resource = new Item($post, new PostTransformer());
    }
} 