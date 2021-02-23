<?php


namespace Scandinaver\Blog\Domain\Services;

use Scandinaver\Blog\Domain\Contract\Repository\CategoryRepositoryInterface;
use Scandinaver\Blog\Domain\Contract\Repository\PostRepositoryInterface;
use Scandinaver\Blog\Domain\Exception\PostNotFoundException;
use Scandinaver\Blog\Domain\Model\Post;
use Scandinaver\Blog\Domain\Model\PostDTO;
use Scandinaver\Shared\Contract\BaseServiceInterface;
use Scandinaver\User\Domain\Model\User;

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
        $result = [];

        /** @var Post[] $posts */
        $posts = $this->postRepository->findAll();
        foreach ($posts as $post) {
            $result[] = $post->toDTO();
        }

        return $result;
    }

    /**
     * @param  int  $id
     *
     * @return PostDTO
     * @throws PostNotFoundException
     */
    public function one(int $id): PostDTO
    {
        $post = $this->getPost($id);

        return $post->toDTO();
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

    public function create(User $user, array $data): PostDTO
    {
        $categoryId = $data['category'];

        $category         = $this->categoryRepository->find($categoryId);
        $data['category'] = $category;
        $data['status']   = $data['status'] ?? 0;

        $post = PostFactory::build($data);

        $this->postRepository->save($post);

        return $post->toDTO();
    }

    /**
     * @param  int    $post
     * @param  array  $data
     *
     * @return PostDTO
     * @throws PostNotFoundException
     */
    public function updatePost(int $post, array $data): PostDTO
    {
        $post = $this->getPost($post);

        $this->postRepository->update($post, $data);

        return $post->toDTO();
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