<?php


namespace Scandinaver\Blog\Domain\Services;

use Scandinaver\Blog\Domain\Contract\Repository\CommentRepositoryInterface;

/**
 * Class CategoryService
 *
 * @package Scandinaver\Blog\Domain\Services
 */
class CommentService
{

    private CommentRepositoryInterface $commentRepository;

    public function __construct(CommentRepositoryInterface $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function getAll(): array
    {
        return $this->commentRepository->all();
    }
}