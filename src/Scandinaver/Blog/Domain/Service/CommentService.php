<?php


namespace Scandinaver\Blog\Domain\Service;

use Scandinaver\Blog\Domain\Contract\Repository\CommentRepositoryInterface;
use Scandinaver\Blog\Domain\Contract\Repository\PostRepositoryInterface;
use Scandinaver\Blog\Domain\Exception\CommentNotFoundException;
use Scandinaver\Blog\Domain\Exception\PostNotFoundException;
use Scandinaver\Blog\Domain\Model\Comment;
use Scandinaver\Blog\Domain\Model\Post;
use Scandinaver\Common\Domain\Contract\UserInterface;
use Scandinaver\Shared\Contract\BaseServiceInterface;

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
        /** @var Comment[] $comments */
        $comments = $this->commentRepository->findAll();

        return $comments;
    }

    /**
     * @param  int  $id
     *
     * @return Comment
     * @throws CommentNotFoundException
     */
    public function one(int $id): Comment
    {
        /** @var Comment $comment */
        $comment = $this->commentRepository->find($id);

        if ($comment === NULL) {
            throw new CommentNotFoundException();
        }

        return $comment;
    }

    /**
     * @param  UserInterface   $user
     * @param  array  $data
     *
     * @return Comment
     * @throws PostNotFoundException
     */
    public function create(UserInterface $user, array $data): Comment
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

        return $comment;
    }

    /**
     * @param  int    $commentId
     * @param  array  $data
     *
     * @return Comment
     * @throws CommentNotFoundException
     */
    public function update(int $commentId, array $data): Comment
    {
        /** @var Comment $comment */
        $comment = $this->commentRepository->find($commentId);

        if ($comment === NULL) {
            throw new CommentNotFoundException();
        }

        $this->commentRepository->update($comment, $data);

        return $comment;
    }

    /**
     * @param  int  $commentId
     *
     * @throws CommentNotFoundException
     */
    public function delete(int $commentId): void
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