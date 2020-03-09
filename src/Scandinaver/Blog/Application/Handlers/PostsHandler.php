<?php


namespace Scandinaver\Blog\Application\Handlers;

use Scandinaver\Blog\Application\Query\PostsQuery;
use Scandinaver\Blog\Domain\Services\BlogService;

/**
 * Class PostsHandler
 * @package Scandinaver\Blog\Application\Handlers
 */
class PostsHandler implements PostsHandlerInterface
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
     * @param PostsQuery
     * @return array
     */
    public function handle($query): array
    {
        return $this->blogService->getAll();
    }
} 