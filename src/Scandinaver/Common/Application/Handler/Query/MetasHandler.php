<?php


namespace Scandinaver\Common\Application\Handler\Query;

use Scandinaver\Common\Domain\Contract\Query\MetasHandlerInterface;
use Scandinaver\Common\UI\Query\MetasQuery;

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
     * @param  MetasQuery
     *
     * @inheritDoc
     */
    public function handle($query)
    {
        // TODO: Implement handle() method.
    }
} 