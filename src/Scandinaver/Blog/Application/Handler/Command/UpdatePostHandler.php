<?php


namespace Scandinaver\Blog\Application\Handler\Command;

use Scandinaver\Blog\Domain\Contract\Command\UpdatePostHandlerInterface;
use Scandinaver\Blog\Domain\Exception\PostNotFoundException;
use Scandinaver\Blog\Domain\Model\PostDTO;
use Scandinaver\Blog\Domain\Services\BlogService;
use Scandinaver\Blog\UI\Command\UpdatePostCommand;
use Scandinaver\Shared\Contract\Command;

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
     * @param  UpdatePostCommand|Command  $command
     *
     * @return PostDTO
     * @throws PostNotFoundException
     */
    public function handle($command): PostDTO
    {
        return $this->blogService->updatePost($command->getPostId(), $command->getData());
    }
} 