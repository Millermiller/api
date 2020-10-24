<?php


namespace Scandinaver\Blog\Application\Handler\Command;

use Scandinaver\Blog\Domain\Contract\Command\CreatePostHandlerInterface;
use Scandinaver\Blog\Domain\Model\PostDTO;
use Scandinaver\Blog\Domain\Services\BlogService;
use Scandinaver\Blog\UI\Command\CreatePostCommand;

/**
 * Class CreatePostHandler
 *
 * @package Scandinaver\Blog\Application\Handler\Command
 */
class CreatePostHandler implements CreatePostHandlerInterface
{
    private BlogService $blogService;

    public function __construct(BlogService $blogService)
    {
        $this->blogService = $blogService;
    }

    /**
     * @param  CreatePostCommand  $command
     *
     * @return PostDTO
     */
    public function handle($command): PostDTO
    {
        return $this->blogService->create($command->getUser(), $command->getData());
    }
} 