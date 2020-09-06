<?php


namespace Scandinaver\Blog\Domain\Services;

use Scandinaver\Blog\Domain\Contract\Repository\PostRepositoryInterface;
use Scandinaver\Blog\Domain\Model\Post;

/**
 * Class BlogService
 *
 * @package Scandinaver\Blog\Domain\Services
 */
class BlogService
{
    private PostRepositoryInterface $postRepository;

    /**
     * PostService constructor.
     *
     * @param  PostRepositoryInterface  $postRepository
     */
    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function getAll(): array
    {
        return $this->postRepository->all();
    }

    public function getOne($id): Post
    {
        /** @var  Post $post */
        $post = $this->postRepository->find($id);
        return $post;
    }

    public function create(array $data): Post
    {
        $post = PostFactory::build($data);

        return $this->postRepository->save($post);
    }

    public function updatePost(Post $post, array $data)
    {
        $this->postRepository->update($post, $data);
    }

    public function deletePost(Post $post)
    {
        $this->postRepository->delete($post);
    }
}