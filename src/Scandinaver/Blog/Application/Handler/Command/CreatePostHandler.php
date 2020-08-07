<?php


namespace Scandinaver\Blog\Application\Handler\Command;

use Scandinaver\Blog\Domain\Contract\Command\CreatePostHandlerInterface;
use Scandinaver\Blog\Domain\Services\BlogService;
use Scandinaver\Blog\UI\Command\CreatePostCommand;

/**
 * Class CreatePostHandler
 *
 * @package Scandinaver\Blog\Application\Handler\Command
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
     * @param  CreatePostCommand
     *
     * @inheritDoc
     */
    public function handle($command): void
    {
        $this->blogService->create($command->getData());
    }
} 