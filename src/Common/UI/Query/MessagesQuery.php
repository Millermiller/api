<?php


namespace Scandinaver\Common\UI\Query;

use Scandinaver\Common\Application\Handler\Query\MessagesQueryHandler;
use Scandinaver\Core\Domain\Attribute\Handler;
use Scandinaver\Core\Domain\Contract\QueryInterface;

/**
 * Class MessagesQuery
 *
 * @package Scandinaver\Common\UI\Query
 */
#[Handler(MessagesQueryHandler::class)]
class MessagesQuery implements QueryInterface
{
    public function __construct()
    {
    }
}