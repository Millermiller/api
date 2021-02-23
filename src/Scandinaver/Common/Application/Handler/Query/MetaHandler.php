<?php


namespace Scandinaver\Common\Application\Handler\Query;

use Scandinaver\Common\Domain\Contract\Query\MetaHandlerInterface;
use Scandinaver\Common\UI\Query\MetaQuery;
use Scandinaver\Shared\Contract\Query;

/**
 * Class MetaHandler
 *
 * @package Scandinaver\Common\Application\Handler\Query
 */
class MetaHandler implements MetaHandlerInterface
{
    public function __construct()
    {
    }

    /**
     * @param  MetaQuery|Query  $query
     */
    public function handle($query)
    {
        // TODO: Implement handle() method.
    }
} 