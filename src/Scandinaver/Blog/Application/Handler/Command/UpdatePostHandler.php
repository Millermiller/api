<?php


namespace Scandinaver\Blog\Application\Handler\Command;

use League\Fractal\Resource\Item;
use Scandinaver\Blog\Domain\Contract\Command\UpdatePostHandlerInterface;
use Scandinaver\Blog\Domain\Exception\PostNotFoundException;
use Scandinaver\Blog\Domain\Services\BlogService;
use Scandinaver\Blog\UI\Command\UpdatePostCommand;
use Scandinaver\Blog\UI\Resources\PostTransformer;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\Command;

/**
 * Class UpdatePostHandler
 *
 * @package Scandinaver\Blog\Application\Handler
 */
class UpdatePostHandler extends AbstractHandler implements UpdatePostHandlerInterface
{
    private BlogService $blogService;

    public function __construct(BlogService $blogService)
    {
        parent::__construct();

        $this->blogService = $blogService;
    }

    /**
     * @param  UpdatePostCommand|Command  $command
     *
     * @throws PostNotFoundException
     */
    public function handle($command): void
    {
        $post = $this->blogService->updatePost($command->getPostId(), $command->getData());

        $this->fractal->parseIncludes('comments');

        $this->resource = new Item($post, new PostTransformer());
    }
} 