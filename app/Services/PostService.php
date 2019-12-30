<?php


namespace App\Services;

use App\Repositories\Post\PostRepositoryInterface;

/**
 * Class ArticleService
 * @package App\Services
 */
class PostService
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