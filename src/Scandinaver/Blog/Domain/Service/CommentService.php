<?php


namespace Scandinaver\Blog\Domain\Service;

use Scandinaver\Blog\Domain\Contract\Repository\CommentRepositoryInterface;
use Scandinaver\Blog\Domain\Contract\Repository\PostRepositoryInterface;
use Scandinaver\Blog\Domain\DTO\CommentDTO;
use Scandinaver\Blog\Domain\Exception\CommentNotFoundException;
use Scandinaver\Blog\Domain\Exception\PostNotFoundException;
use Scandinaver\Blog\Domain\Entity\Comment;
use Scandinaver\Shared\Contract\BaseServiceInterface;
use Scandinaver\User\Domain\Exception\UserNotFoundException;

/**
 * Class CategoryService
 *
 * @package Scandinaver\Blog\Domain\Services
 */
class CommentService implements BaseServiceInterface
{

    private CommentRepositoryInterface $commentRepository;

    private PostRepositoryInterface $postRepository;

    private CommentFactory $commentFactory;

    public function __construct(
        CommentRepositoryInterface $commentRepository,
        PostRepositoryInterface $postRepository,
        CommentFactory $commentFactory
    ) {
        $this->commentRepository = $commentRepository;
        $this->postRepository    = $postRepository;
        $this->commentFactory    = $commentFactory;
    }

    public function all(): array
    {
        return $this->commentRepository->findAll();
    }

    /**
     * @param  int  $id
     *
     * @return Comment
     * @throws CommentNotFoundException
     */
    public function one(int $id): Comment
    {
        $comment = $this->commentRepository->find($id);

        if ($comment === NULL) {
            throw new CommentNotFoundException();
        }

        return $comment;
    }

    /**
     * @param  CommentDTO  $commentDTO
     *
     * @return Comment
     * @throws PostNotFoundException
     * @throws UserNotFoundException
     */
    public function create(CommentDTO $commentDTO): Comment
    {
        $comment = $this->commentFactory->fromDTO($commentDTO);

        $this->commentRepository->save($comment);

        return $comment;
    }

    /**
     * @param  int         $commentId
     * @param  CommentDTO  $commentDTO
     *
     * @return Comment
     * @throws CommentNotFoundException
     */
    public function update(int $commentId, CommentDTO $commentDTO): Comment
    {
        $comment = $this->commentRepository->find($commentId);

        if ($comment === NULL) {
            throw new CommentNotFoundException();
        }

        $comment->setText($commentDTO->getText());

        $this->commentRepository->save($comment);

        return $comment;
    }

    /**
     * @param  int  $commentId
     *
     * @throws CommentNotFoundException
     */
    public function delete(int $commentId): void
    {
        $comment = $this->commentRepository->find($commentId);

        if ($comment === NULL) {
            throw new CommentNotFoundException();
        }

        $this->commentRepository->delete($comment);
    }
}