<?php


namespace Scandinaver\Blog\UI\Query;

use Scandinaver\Blog\Application\Handler\Query\CommentsQueryHandler;
use Scandinaver\Core\Domain\Attribute\Handler;
use Scandinaver\Core\Domain\Contract\QueryInterface;
use Scandinaver\Core\Domain\FilteringQuery;

/**
 * Class CommentsQuery
 *
 * @package Scandinaver\Blog\UI\Query
 */
#[Handler(CommentsQueryHandler::class)]
class CommentsQuery extends FilteringQuery implements QueryInterface
{

}