<?php


namespace Scandinaver\Blog\UI\Query;

use Scandinaver\Blog\Application\Handler\Query\PostsQueryHandler;
use Scandinaver\Core\Domain\Attribute\Handler;
use Scandinaver\Core\Domain\Contract\QueryInterface;
use Scandinaver\Core\Domain\FilteringQuery;

/**
 * Class PostsQuery
 *
 * @package Scandinaver\Blog\UI\Query
 */
#[Handler(PostsQueryHandler::class)]
class PostsQuery extends FilteringQuery implements QueryInterface
{

}