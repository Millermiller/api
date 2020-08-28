<?php


namespace Scandinaver\Blog\Application\Handler\Command;

use Scandinaver\Blog\Domain\Contract\Command\DeletePostHandlerInterface;
use Scandinaver\Blog\Domain\Services\BlogService;
use Scandinaver\Blog\UI\Command\DeletePostCommand;

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
     * @param  DeletePostCommand
     *
     * @inheritDoc
     */
    public function handle($command): void
    {
        $this->blogService->deletePost($command->getPost());
    }
} 