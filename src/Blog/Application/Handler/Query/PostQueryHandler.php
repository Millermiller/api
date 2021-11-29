<?php


namespace Scandinaver\Blog\Application\Handler\Query;

use League\Fractal\Resource\Item;
use Scandinaver\Blog\Domain\Exception\PostNotFoundException;
use Scandinaver\Blog\Domain\Service\BlogService;
use Scandinaver\Blog\UI\Query\PostQuery;
use Scandinaver\Blog\UI\Resources\PostTransformer;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\BaseCommandInterface;

/**
 * Class PostQueryHandler
 *
 * @package Scandinaver\Blog\Application\Handler\Query
 */
class PostQueryHandler extends AbstractHandler
{

    public function __construct(private BlogService $service)
    {
        parent::__construct();
    }

    /**
     * @param  PostQuery $query
     *
     * @throws PostNotFoundException
     */
    public function handle(BaseCommandInterface $query): void
    {
        $post = $this->service->one($query->getId());

        $this->fractal->parseIncludes('comments');

        $this->resource = new Item($post, new PostTransformer(), 'post');
    }
} 