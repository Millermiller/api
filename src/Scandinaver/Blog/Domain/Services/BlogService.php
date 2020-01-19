<?php


namespace Scandinaver\Blog\Domain\Services;

use Scandinaver\Blog\Domain\Contracts\PostRepositoryInterface;

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
}