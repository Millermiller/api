<?php


namespace Scandinaver\Blog\Domain\Service;


use Scandinaver\Blog\Domain\Contract\Repository\PostRepositoryInterface;
use Scandinaver\Blog\Domain\DTO\CommentDTO;
use Scandinaver\Blog\Domain\Exception\PostNotFoundException;
use Scandinaver\Blog\Domain\Model\Comment;
use Scandinaver\Blog\Domain\Model\Post;
use Scandinaver\User\Domain\Contract\Repository\UserRepositoryInterface;
use Scandinaver\User\Domain\Exception\UserNotFoundException;
use Scandinaver\User\Domain\Model\User;

/**
 * Class CommentFactory
 *
 * @package Scandinaver\Blog\Domain\Service
 */
class CommentFactory
{

    private UserRepositoryInterface $userRepository;

    private PostRepositoryInterface $postRepository;

    public function __construct(
        UserRepositoryInterface $userRepository,
        PostRepositoryInterface $postRepository
    )
    {
        $this->userRepository = $userRepository;
        $this->postRepository = $postRepository;
    }

    /**
     * @param  CommentDTO  $commentDTO
     *
     * @return Comment
     * @throws PostNotFoundException
     * @throws UserNotFoundException
     */
    public function fromDTO(CommentDTO $commentDTO): Comment
    {
        $userId = $commentDTO->getUserId();
        $postId = $commentDTO->getPostId();

        /** @var User $user */
        $user = $this->userRepository->find($userId);
        if ($user === NULL) {
            throw new UserNotFoundException();
        }

        /** @var Post $post */
        $post = $this->postRepository->find($postId);
        if ($post === NULL) {
            throw new PostNotFoundException();
        }

        $comment = new Comment();
        $comment->setText($commentDTO->getText());
        $comment->setUser($user);
        $comment->setPost($post);

        return $comment;
    }

    public function toDTO(CommentDTO $commentDTO): CommentDTO
    {

    }
}