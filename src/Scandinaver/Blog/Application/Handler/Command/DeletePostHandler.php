<?php


namespace Scandinaver\Blog\Application\Handler\Command;

use Scandinaver\Blog\Domain\Contract\Command\DeletePostHandlerInterface;
use Scandinaver\Blog\Domain\Exception\PostNotFoundException;
use Scandinaver\Blog\Domain\Services\BlogService;
use Scandinaver\Blog\UI\Command\DeletePostCommand;
use Scandinaver\Shared\Contract\Command;

/**
 * Class DeletePostHandler
 *
 * @package Scandinaver\Blog\Application\Handler\Command
 */
class DeletePostHandler implements DeletePostHandlerInterface
{
    private BlogService $blogService;

    public function __construct(BlogService $blogService)
    {
        $this->blogService = $blogService;
    }

    /**
     * @param  DeletePostCommand|Command  $command
     *
     * @throws PostNotFoundException
     */
    public function handle($command): void
    {
        $this->blogService->deletePost($command->getPostId());
    }
} 