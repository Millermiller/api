<?php


namespace Scandinaver\Blog\Application\Handlers;

use Scandinaver\Blog\Application\Commands\UpdatePostCommand;
use Scandinaver\Blog\Domain\Services\BlogService;

/**
 * Class UpdatePostHandler
 *
 * @package Scandinaver\Blog\Application\Handlers
 */
class UpdatePostHandler implements UpdatePostHandlerInterface
{
    /**
     * @var BlogService
     */
    private $blogService;

    public function __construct(BlogService $blogService)
    {
        $this->blogService = $blogService;
    }

    /**
     * @param UpdatePostCommand
     */
    public function handle($command): void
    {
        $this->blogService->updatePost($command->getPost(), $command->getData());
    }
} 