<?php


namespace Scandinaver\Blog\Application\Handler\Command;

use League\Fractal\Resource\Item;
use Scandinaver\Blog\Domain\Exception\CategoryNotFoundException;
use Scandinaver\Blog\Domain\Service\BlogService;
use Scandinaver\Blog\UI\Command\CreatePostCommand;
use Scandinaver\Blog\UI\Resources\PostTransformer;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\BaseCommandInterface;

/**
 * Class CreatePostCommandHandler
 *
 * @package Scandinaver\Blog\Application\Handler\Command
 */
class CreatePostCommandHandler extends AbstractHandler
{

    private BlogService $blogService;

    public function __construct(BlogService $blogService)
    {
        parent::__construct();

        $this->blogService = $blogService;
    }

    /**
     * @param  CreatePostCommand|BaseCommandInterface  $command
     *
     * @throws CategoryNotFoundException
     */
    public function handle(BaseCommandInterface $command): void
    {
        $post = $this->blogService->create($command->buildDTO());

        $this->fractal->parseIncludes('comments');

        $this->resource = new Item($post, new PostTransformer());
    }
} 