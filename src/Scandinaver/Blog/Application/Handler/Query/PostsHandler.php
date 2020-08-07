<?php


namespace Scandinaver\Blog\Application\Handler\Query;

use Scandinaver\Blog\Domain\Contract\Query\PostsHandlerInterface;
use Scandinaver\Blog\Domain\Services\BlogService;
use Scandinaver\Blog\UI\Query\PostsQuery;

/**
 * Class PostsHandler
 *
 * @package Scandinaver\Blog\Application\Handler\Query
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
     * @param  PostsQuery  $query
     *
     * @return array
     */
    public function handle($query): array
    {
        return $this->blogService->getAll();
    }
} 