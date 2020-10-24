<?php


namespace Scandinaver\Blog\Application\Handler\Command;

use Scandinaver\Blog\Domain\Contract\Command\UpdatePostHandlerInterface;
use Scandinaver\Blog\Domain\Model\PostDTO;
use Scandinaver\Blog\Domain\Services\BlogService;
use Scandinaver\Blog\UI\Command\UpdatePostCommand;

/**
 * Class UpdatePostHandler
 *
 * @package Scandinaver\Blog\Application\Handler
 */
class UpdatePostHandler implements UpdatePostHandlerInterface
{
    private BlogService $blogService;

    public function __construct(BlogService $blogService)
    {
        $this->blogService = $blogService;
    }

    /**
     * @param  UpdatePostCommand  $command
     *
     * @return PostDTO
     */
    public function handle($command): PostDTO
    {
        return $this->blogService->updatePost($command->getPostId(), $command->getData());
    }
} 