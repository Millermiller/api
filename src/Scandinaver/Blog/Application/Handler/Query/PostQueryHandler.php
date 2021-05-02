<?php


namespace Scandinaver\Blog\Application\Handler\Query;

use League\Fractal\Resource\Item;
use Scandinaver\Blog\Domain\Exception\PostNotFoundException;
use Scandinaver\Blog\Domain\Service\BlogService;
use Scandinaver\Blog\UI\Query\PostQuery;
use Scandinaver\Blog\UI\Resources\PostTransformer;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class PostQueryHandler
 *
 * @package Scandinaver\Blog\Application\Handler\Query
 */
class PostQueryHandler extends AbstractHandler
{
    private BlogService $blogService;

    public function __construct(BlogService $blogService)
    {
        parent::__construct();

        $this->blogService = $blogService;
    }

    /**
     * @param  PostQuery|CommandInterface  $query
     *
     * @throws PostNotFoundException
     */
    public function handle(CommandInterface $query): void
    {
        $post = $this->blogService->one($query->getId());

        $this->fractal->parseIncludes('comments');

        $this->resource = new Item($post, new PostTransformer());
    }
} 