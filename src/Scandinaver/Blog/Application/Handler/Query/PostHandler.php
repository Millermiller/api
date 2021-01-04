<?php


namespace Scandinaver\Blog\Application\Handler\Query;

use Scandinaver\Blog\Domain\Contract\Query\PostHandlerInterface;
use Scandinaver\Blog\Domain\Exception\PostNotFoundException;
use Scandinaver\Blog\Domain\Model\PostDTO;
use Scandinaver\Blog\Domain\Services\BlogService;
use Scandinaver\Blog\UI\Query\PostQuery;
use Scandinaver\Shared\Contract\Query;

/**
 * Class PostHandler
 *
 * @package Scandinaver\Blog\Application\Handler\Query
 */
class PostHandler implements PostHandlerInterface
{
    private BlogService $blogService;

    public function __construct(BlogService $blogService)
    {
        $this->blogService = $blogService;
    }

    /**
     * @param  PostQuery|Query  $query
     *
     * @return PostDTO
     * @throws PostNotFoundException
     */
    public function handle($query): PostDTO
    {
        return $this->blogService->one($query->getId());
    }
} 