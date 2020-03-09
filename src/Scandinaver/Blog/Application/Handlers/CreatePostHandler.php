<?php


namespace Scandinaver\Blog\Application\Handlers;

use Scandinaver\Blog\Application\Commands\CreatePostCommand;
use Scandinaver\Blog\Domain\Services\BlogService;

/**
 * Class CreatePostHandler
 * @package Scandinaver\Blog\Application\Handlers
 */
class CreatePostHandler implements CreatePostHandlerInterface
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
     * @param CreatePostCommand
     * @inheritDoc
     */
    public function handle($command): void
    {
        $this->blogService->create($command->getData());
    }
} 