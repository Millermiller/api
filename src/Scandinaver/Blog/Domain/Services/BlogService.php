<?php


namespace Scandinaver\Blog\Domain\Services;

use Scandinaver\Blog\Domain\Contracts\PostRepositoryInterface;
use Scandinaver\Blog\Domain\Post;

/**
 * Class ArticleService
 * @package App\Services
 */
class BlogService
{
    /**
     * @var PostRepositoryInterface
     */
    private $postRepository;

    /**
     * PostService constructor.
     * @param PostRepositoryInterface $postRepository
     */
    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    /**
     * @return array
     */
    public function getAll(): array
    {
        return $this->postRepository->all();
    }

    /**
     * @param $id
     * @return Post
     */
    public function getOne($id): Post
    {
        return $this->postRepository->get($id);
    }

    /**
     * @param array $data
     * @return Post
     */
    public function create(array $data): Post
    {
        $post = new Post();

        $post->setUser(\Auth::user());
        $post->setTitle($data['title']);
        $post->setCategory($data['category']);
        $post->setContent($data['content']);

        return $this->postRepository->save($post);
    }

    public function updatePost(Post $post, array $data)
    {
        $this->postRepository->update($post, $data);
    }

    /**
     * @param Post $post
     */
    public function deletePost(Post $post)
    {
        $this->postRepository->delete($post);
    }
}