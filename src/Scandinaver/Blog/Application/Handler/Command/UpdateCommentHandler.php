<?php


namespace Scandinaver\Blog\Application\Handler\Command;

use Scandinaver\Blog\Domain\Contract\Command\UpdateCommentHandlerInterface;
use Scandinaver\Blog\Domain\Model\CommentDTO;
use Scandinaver\Blog\Domain\Services\CommentService;
use Scandinaver\Blog\UI\Command\UpdateCommentCommand;

/**
 * Class UpdateCommentHandler
 *
 * @package Scandinaver\Blog\Application\Handler
 */
class UpdateCommentHandler implements UpdateCommentHandlerInterface
{

    private CommentService $service;

    public function __construct(CommentService $service)
    {
        $this->service = $service;
    }

    /**
     * @param  UpdateCommentCommand  $command
     *
     * @return CommentDTO
     */
    public function handle($command): CommentDTO
    {
        return $this->service->update($command->getCommentId(), $command->getData());
    }
} 