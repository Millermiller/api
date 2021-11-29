<?php


namespace Scandinaver\Common\UI\Query;

use Scandinaver\Common\Application\Handler\Query\MessagesQueryHandler;
use Scandinaver\Core\Domain\Attribute\Query;
use Scandinaver\Core\Domain\Contract\QueryInterface;

/**
 * Class MessagesQuery
 *
 * @package Scandinaver\Common\UI\Query
 */
#[Query(MessagesQueryHandler::class)]
class MessagesQuery implements QueryInterface
{
    public function __construct()
    {
    }
}