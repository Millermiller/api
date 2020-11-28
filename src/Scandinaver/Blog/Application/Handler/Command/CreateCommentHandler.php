<?php


namespace Scandinaver\Blog\Application\Handler\Command;

use Scandinaver\Blog\Domain\Contract\Command\CreateCommentHandlerInterface;
use Scandinaver\Blog\Domain\Exception\PostNotFoundException;
use Scandinaver\Blog\Domain\Model\CommentDTO;
use Scandinaver\Blog\Domain\Services\CommentService;
use Scandinaver\Blog\UI\Command\CreateCommentCommand;

/**
 * Class CreateCommentHandler
 *
 * @package Scandinaver\Blog\Application\Handler\Command
 */
class CreateCommentHandler implements CreateCommentHandlerInterface
{

    private CommentService $service;

    public function __construct(CommentService $service)
    {
        $this->service = $service;
    }

    /**
     * @param  CreateCommentCommand  $command
     *
     * @return CommentDTO
     * @throws PostNotFoundException
     */
    public function handle($command): CommentDTO
    {
        return $this->service->create($command->getUser(), $command->getData());
    }
}