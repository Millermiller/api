<?php


namespace Scandinaver\Blog\Domain\Services;

use Scandinaver\Blog\Domain\Contract\Repository\CategoryRepositoryInterface;
use Scandinaver\Blog\Domain\Contract\Repository\PostRepositoryInterface;
use Scandinaver\Blog\Domain\DTO\PostDTO;
use Scandinaver\Blog\Domain\Exception\PostNotFoundException;
use Scandinaver\Blog\Domain\Model\Category;
use Scandinaver\Blog\Domain\Model\Post;
use Scandinaver\Common\Domain\Contract\UserInterface;
use Scandinaver\Shared\Contract\BaseServiceInterface;

/**
 * Class BlogService
 *
 * @package Scandinaver\Blog\Domain\Services
 */
class BlogService implements BaseServiceInterface
{

    private PostRepositoryInterface $postRepository;

    private CategoryRepositoryInterface $categoryRepository;

    public function __construct(
        PostRepositoryInterface $postRepository,
        CategoryRepositoryInterface $categoryRepository
    ) {
        $this->postRepository     = $postRepository;
        $this->categoryRepository = $categoryRepository;
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

    public function create(UserInterface $user, array $data): Post
    {
        $categoryId = $data['category'];
        /** @var Category $category */
        $category = $this->categoryRepository->find($categoryId);

        $postDTO = new PostDTO();
        $postDTO->setTitle($data['title']);
        $postDTO->setCategory($category);
        $postDTO->setStatus($data['status'] ?? 0);
        $postDTO->setContent($data['content']);
        $postDTO->setAnonce($data['anonce'] ?? '');
        $postDTO->setUser($user);

        $post = PostFactory::fromDTO($postDTO);

        $this->postRepository->save($post);

        return $post;
    }

    /**
     * @param  int    $post
     * @param  array  $data
     *
     * @return Post
     * @throws PostNotFoundException
     */
    public function updatePost(int $post, array $data): Post
    {
        $post = $this->getPost($post);

        $this->postRepository->update($post, $data);

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
        $post->delete();
        $this->postRepository->delete($post);
    }

}