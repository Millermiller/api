<?php


namespace Scandinaver\Blog\Domain\Services;

use Auth;
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
        return $this->postRepository->find($id);
    }

    public function create(array $data): Post
    {
        $post = new Post();

        $post->setUser(Auth::user());
        $post->setTitle($data['title']);
        $post->setCategory($data['category']);
        $post->setContent($data['content']);

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