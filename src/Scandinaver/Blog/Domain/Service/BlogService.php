<?php


namespace Scandinaver\Blog\Domain\Service;

use Scandinaver\Blog\Domain\Contract\Repository\CategoryRepositoryInterface;
use Scandinaver\Blog\Domain\Contract\Repository\PostRepositoryInterface;
use Scandinaver\Blog\Domain\DTO\PostDTO;
use Scandinaver\Blog\Domain\Exception\CategoryNotFoundException;
use Scandinaver\Blog\Domain\Exception\PostNotFoundException;
use Scandinaver\Blog\Domain\Entity\Post;
use Scandinaver\Shared\Contract\BaseServiceInterface;
use Scandinaver\User\Domain\Exception\UserNotFoundException;

/**
 * Class BlogService
 *
 * @package Scandinaver\Blog\Domain\Services
 */
class BlogService implements BaseServiceInterface
{

    private PostRepositoryInterface $postRepository;

    private CategoryRepositoryInterface $categoryRepository;

    private PostFactory $postFactory;

    public function __construct(
        PostRepositoryInterface $postRepository,
        CategoryRepositoryInterface $categoryRepository,
        PostFactory $postFactory
    ) {
        $this->postRepository     = $postRepository;
        $this->categoryRepository = $categoryRepository;
        $this->postFactory        = $postFactory;
    }

    public function all(): array
    {
        return $this->postRepository->findAll();
    }

    /**
     * @param  int  $id
     *
     * @return Post
     * @throws PostNotFoundException
     */
    public function one(int $id): Post
    {
        return $this->getPost($id);
    }

    /**
     * @param  int  $id
     *
     * @return Post
     * @throws PostNotFoundException
     */
    private function getPost(int $id): Post
    {
        /** @var  Post $post */
        $post = $this->postRepository->find($id);
        if ($post === NULL) {
            throw new PostNotFoundException();
        }

        return $post;
    }

    /**
     * @param  PostDTO  $postDTO
     *
     * @return Post
     * @throws CategoryNotFoundException
     * @throws UserNotFoundException
     */
    public function create(PostDTO $postDTO): Post
    {
        $post = $this->postFactory->fromDTO($postDTO);

        $this->postRepository->save($post);

        return $post;
    }

    /**
     * @param  int      $post
     * @param  PostDTO  $postDTO
     *
     * @return Post
     * @throws CategoryNotFoundException
     * @throws PostNotFoundException
     * @throws UserNotFoundException
     */
    public function updatePost(int $post, PostDTO $postDTO): Post
    {
        $post = $this->getPost($post);

        $post = $this->postFactory->update($post, $postDTO);

        $this->postRepository->save($post);

        return $post;
    }

    /**
     * @param  int  $post
     *
     * @throws PostNotFoundException
     */
    public function deletePost(int $post)
    {
        $post = $this->getPost($post);
        $this->postRepository->delete($post);
    }

}