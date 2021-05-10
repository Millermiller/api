<?php


namespace Scandinaver\Blog\Domain\Service;

use Scandinaver\Blog\Domain\Contract\Repository\CategoryRepositoryInterface;
use Scandinaver\Blog\Domain\DTO\PostDTO;
use Scandinaver\Blog\Domain\Exception\CategoryNotFoundException;
use Scandinaver\Blog\Domain\Model\{Category, Post};
use Scandinaver\Common\Domain\Contract\UserInterface;
use Scandinaver\User\Domain\Contract\Repository\UserRepositoryInterface;
use Scandinaver\User\Domain\Exception\UserNotFoundException;

/**
 * Class PostFactory
 *
 * @package Scandinaver\Blog\Domain\Services
 */
class PostFactory
{

    private CategoryRepositoryInterface $categoryRepository;

    private UserRepositoryInterface $userRepository;

    public function __construct(
        CategoryRepositoryInterface $categoryRepository,
        UserRepositoryInterface $userRepository
    )
    {
        $this->categoryRepository = $categoryRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * @param  PostDTO  $postDTO
     *
     * @return Post
     * @throws CategoryNotFoundException|UserNotFoundException
     */
    public function fromDTO(PostDTO $postDTO): Post
    {
        $categoryId = $postDTO->getCategoryId();
        /** @var Category $category */
        $category = $this->categoryRepository->find($categoryId);
        if ($category === NULL) {
            throw new CategoryNotFoundException();
        }

        $userId = $postDTO->getUserId();
        /** @var UserInterface $user */
        $user = $this->userRepository->find($userId);
        if ($user === NULL) {
            throw new UserNotFoundException();
        }

        $post = new Post();

        $post->setTitle($postDTO->getTitle());
        $post->setCategory($category);
        $post->setUser($user);
        $post->setContent($postDTO->getContent());
        $post->setAnonse($postDTO->getAnonce());
        $post->setStatus($postDTO->getStatus());
        $post->setCommentStatus(1);
        $post->setViews(0);

        return $post;
    }

    public function toDTO(Post $post): PostDTO
    {
        return PostDTO::fromArray([
            'id'       => $post->getId(),
            'title'    => $post->getTitle(),
            'category' => $post->getCategory()->getId(),
            'status'   => $post->getStatus(),
            'content'  => $post->getContent(),
            'anonce'   => $post->getAnonse(),
            'userId'   => $post->getUser()->getId(),
        ]);
    }

    /**
     * @param  Post     $post
     * @param  PostDTO  $postDTO
     *
     * @return Post
     * @throws CategoryNotFoundException
     * @throws UserNotFoundException
     */
    public function update(Post $post, PostDTO $postDTO): Post
    {
        $userId = $postDTO->getUserId();
        /** @var UserInterface $user */
        $user = $this->userRepository->find($userId);
        if ($user === NULL) {
            throw new UserNotFoundException();
        }

        $categoryId = $postDTO->getCategoryId();
        /** @var Category $category */
        $category = $this->categoryRepository->find($categoryId);
        if ($category === NULL) {
            throw new CategoryNotFoundException();
        }

        $post->setTitle($postDTO->getTitle());
        $post->setContent($postDTO->getContent());
        $post->setStatus($postDTO->getStatus());
        $post->setAnonse($postDTO->getAnonce());
        $post->setUser($user);
        $post->setCategory($category);

        return $post;
    }
}