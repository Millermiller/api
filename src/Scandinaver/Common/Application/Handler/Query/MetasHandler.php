<?php


namespace Scandinaver\Common\Application\Handler\Query;

use Scandinaver\Common\Domain\Contract\Query\MetasHandlerInterface;
use Scandinaver\Common\UI\Query\MetasQuery;
use Scandinaver\Shared\Contract\Query;

/**
 * Class MetasHandler
 *
 * @package Scandinaver\Common\Application\Handler\Query
 */
class MetasHandler implements MetasHandlerInterface
{
    public function __construct()
    {
    }

    /**
     * @param  MetasQuery|Query  $query
     */
    public function handle($query)
    {
        // TODO: Implement handle() method.
    }
} 