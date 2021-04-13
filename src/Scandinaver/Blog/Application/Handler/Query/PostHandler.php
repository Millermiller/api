<?php


namespace Scandinaver\Blog\Application\Handler\Query;

use League\Fractal\Resource\Item;
use Scandinaver\Blog\Domain\Contract\Query\PostHandlerInterface;
use Scandinaver\Blog\Domain\Exception\PostNotFoundException;
use Scandinaver\Blog\Domain\Services\BlogService;
use Scandinaver\Blog\UI\Query\PostQuery;
use Scandinaver\Blog\UI\Resources\PostTransformer;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\Query;

/**
 * Class PostHandler
 *
 * @package Scandinaver\Blog\Application\Handler\Query
 */
class PostHandler extends AbstractHandler implements PostHandlerInterface
{
    private BlogService $blogService;

    public function __construct(BlogService $blogService)
    {
        parent::__construct();

        $this->blogService = $blogService;
    }

    /**
     * @param  PostQuery|Query  $query
     *
     * @throws PostNotFoundException
     */
    public function handle($query): void
    {
        $post = $this->blogService->one($query->getId());

        $this->fractal->parseIncludes('comments');

        $this->resource = new Item($post, new PostTransformer());
    }
} 