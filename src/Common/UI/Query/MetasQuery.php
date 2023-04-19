<?php


namespace Scandinaver\Common\UI\Query;

use Scandinaver\Common\Application\Handler\Query\MetasQueryHandler;
use Scandinaver\Core\Domain\Attribute\Handler;
use Scandinaver\Core\Domain\Contract\QueryInterface;

/**
 * Class MetasQuery
 *
 * @package Scandinaver\Common\UI\Query
 */
#[Handler(MetasQueryHandler::class)]
class MetasQuery implements QueryInterface
{
    public function __construct()
    {
    }
}