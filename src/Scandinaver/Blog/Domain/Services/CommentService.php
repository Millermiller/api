<?php


namespace Scandinaver\Blog\Domain\Services;

use Scandinaver\Blog\Domain\Contract\Repository\CommentRepositoryInterface;
use Scandinaver\Blog\Domain\Contract\Repository\PostRepositoryInterface;
use Scandinaver\Blog\Domain\Exception\CommentNotFoundException;
use Scandinaver\Blog\Domain\Exception\PostNotFoundException;
use Scandinaver\Blog\Domain\Model\Comment;
use Scandinaver\Blog\Domain\Model\CommentDTO;
use Scandinaver\Blog\Domain\Model\Post;
use Scandinaver\Shared\Contract\BaseServiceInterface;
use Scandinaver\User\Domain\Model\User;

/**
 * Class CategoryService
 *
 * @package Scandinaver\Blog\Domain\Services
 */
class CommentService implements BaseServiceInterface
{
    private CommentRepositoryInterface $commentRepository;

    private PostRepositoryInterface $postRepository;

    public function __construct(
        CommentRepositoryInterface $commentRepository,
        PostRepositoryInterface $postRepository
    ) {
        $this->commentRepository = $commentRepository;
        $this->postRepository    = $postRepository;
    }

    public function all(): array
    {
        $result = [];

        /** @var Comment[] $comments */
        $comments = $this->commentRepository->findAll();

        foreach ($comments as $comment) {
            $result[] = $comment->toDTO();
        }

        return $result;
    }

    /**
     * @param  int  $id
     *
     * @return CommentDTO
     * @throws CommentNotFoundException
     */
    public function one(int $id): CommentDTO
    {
        /** @var Comment $comment */
        $comment = $this->commentRepository->find($id);

        if ($comment === NULL) {
            throw new CommentNotFoundException();
        }

        return $comment->toDTO();
    }

    /**
     * @param  User   $user
     * @param  array  $data
     *
     * @return CommentDTO
     * @throws PostNotFoundException
     */
    public function create(User $user, array $data): CommentDTO
    {
        /** @var Post $post */
        $post = $this->postRepository->find($data['post_id']);

        if ($post === NULL) {
            throw new PostNotFoundException();
        }

        $comment = new Comment();
        $comment->setText($data['text']);
        $comment->setUser($user);
        $comment->setPost($post);

        $this->commentRepository->save($comment);

        return $comment->toDTO();
    }

    /**
     * @param  int    $commentId
     * @param  array  $data
     *
     * @return CommentDTO
     * @throws CommentNotFoundException
     */
    public function update(int $commentId, array $data): CommentDTO
    {
        /** @var Comment $comment */
        $comment = $this->commentRepository->find($commentId);

        if ($comment === NULL) {
            throw new CommentNotFoundException();
        }

        $this->commentRepository->update($comment, $data);

        return $comment->toDTO();
    }

    /**
     * @param  int  $commentId
     *
     * @throws CommentNotFoundException
     */
    public function delete(int $commentId)
    {
        /** @var Comment $comment */
        $comment = $this->commentRepository->find($commentId);

        if ($comment === NULL) {
            throw new CommentNotFoundException();
        }

        $comment->delete();

        $this->commentRepository->delete($comment);
    }
}