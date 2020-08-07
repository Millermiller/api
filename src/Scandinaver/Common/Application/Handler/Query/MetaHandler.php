<?php


namespace Scandinaver\Common\Application\Handler\Query;

use Scandinaver\Common\Domain\Contract\Query\MetaHandlerInterface;
use Scandinaver\Common\UI\Query\MetaQuery;

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
     * @param  MetaQuery
     *
     * @inheritDoc
     */
    public function handle($query)
    {
        // TODO: Implement handle() method.
    }
} 