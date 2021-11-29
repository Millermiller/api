<?php


namespace Scandinaver\Blog\UI\Query;

use Scandinaver\Blog\Application\Handler\Query\CommentsQueryHandler;
use Scandinaver\Core\Domain\Attribute\Query;
use Scandinaver\Core\Domain\Contract\QueryInterface;

/**
 * Class CommentsQuery
 *
 * @package Scandinaver\Blog\UI\Query
 */
#[Query(CommentsQueryHandler::class)]
class CommentsQuery implements QueryInterface
{

    public function __construct()
    {
    }
}