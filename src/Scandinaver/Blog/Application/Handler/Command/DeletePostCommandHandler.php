<?php


namespace Scandinaver\Blog\Application\Handler\Command;

use League\Fractal\Resource\NullResource;
use Scandinaver\Blog\Domain\Exception\PostNotFoundException;
use Scandinaver\Blog\Domain\Service\BlogService;
use Scandinaver\Blog\UI\Command\DeletePostCommand;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\BaseCommandInterface;

/**
 * Class DeletePostCommandHandler
 *
 * @package Scandinaver\Blog\Application\Handler\Command
 */
class DeletePostCommandHandler extends AbstractHandler
{

    private BlogService $blogService;

    public function __construct(BlogService $blogService)
    {
        parent::__construct();

        $this->blogService = $blogService;
    }

    /**
     * @param  DeletePostCommand|BaseCommandInterface  $command
     *
     * @throws PostNotFoundException
     */
    public function handle(BaseCommandInterface $command): void
    {
        $this->blogService->deletePost($command->getPostId());

        $this->resource = new NullResource();
    }
} 