<?php


namespace Scandinaver\Blog\Application\Handlers;

use Scandinaver\Blog\Application\Commands\DeletePostCommand;
use Scandinaver\Blog\Domain\Services\BlogService;

/**
 * Class DeletePostHandler
 *
 * @package Scandinaver\Blog\Application\Handlers
 */
class DeletePostHandler implements DeletePostHandlerInterface
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
     * @param DeletePostCommand
     *
     * @inheritDoc
     */
    public function handle($command): void
    {
        $this->blogService->deletePost($command->getPost());
    }
} 