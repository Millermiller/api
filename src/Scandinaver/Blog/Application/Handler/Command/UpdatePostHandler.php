<?php


namespace Scandinaver\Blog\Application\Handler\Command;

use Scandinaver\Blog\Domain\Contract\Command\UpdatePostHandlerInterface;
use Scandinaver\Blog\Domain\Services\BlogService;
use Scandinaver\Blog\UI\Command\UpdatePostCommand;

/**
 * Class UpdatePostHandler
 *
 * @package Scandinaver\Blog\Application\Handler
 */
class UpdatePostHandler implements UpdatePostHandlerInterface
{
    /**
     * @var BlogService
     */
    private BlogService $blogService;

    public function __construct(BlogService $blogService)
    {
        $this->blogService = $blogService;
    }

    /**
     * @param  UpdatePostCommand
     */
    public function handle($command): void
    {
        $this->blogService->updatePost($command->getPost(), $command->getData());
    }
} 