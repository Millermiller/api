<?php


namespace Scandinaver\Blog\Application\Handler\Query;

use Scandinaver\Blog\Domain\Contract\Query\PostHandlerInterface;
use Scandinaver\Blog\Domain\Model\Post;
use Scandinaver\Blog\Domain\Services\BlogService;
use Scandinaver\Blog\UI\Query\PostQuery;

/**
 * Class PostHandler
 *
 * @package Scandinaver\Blog\Application\Handler\Query
 */
class PostHandler implements PostHandlerInterface
{
    /**
     * @var BlogService
     */
    private BlogService $blogService;

    public function __construct(BlogService $blogService)
    {
        $this->blogService = $blogService;
    }

    /**
     * @param $query PostQuery
     *
     * @return Post
     */
    public function handle($query): Post
    {
        return $this->blogService->getOne($query->getId());
    }
} 