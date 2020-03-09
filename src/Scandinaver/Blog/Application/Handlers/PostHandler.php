<?php


namespace Scandinaver\Blog\Application\Handlers;

use Scandinaver\Blog\Application\Query\PostQuery;
use Scandinaver\Blog\Domain\Post;
use Scandinaver\Blog\Domain\Services\BlogService;

/**
 * Class PostHandler
 * @package Scandinaver\Blog\Application\Handlers
 */
class PostHandler implements PostHandlerInterface
{
    /**
     * @var BlogService
     */
    private $blogService;

    public function __construct(BlogService $blogService)
    {
        $this->blogService = $blogService;
    }

    /**
     * @param PostQuery
     * @return Post
     */
    public function handle($query): Post
    {
        return $this->blogService->getOne($query->getId());
    }
} 