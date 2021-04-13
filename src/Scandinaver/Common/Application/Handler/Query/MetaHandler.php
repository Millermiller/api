<?php


namespace Scandinaver\Common\Application\Handler\Query;

use Scandinaver\Common\Domain\Contract\Query\MetaHandlerInterface;
use Scandinaver\Common\UI\Query\MetaQuery;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\Query;

/**
 * Class MetaHandler
 *
 * @package Scandinaver\Common\Application\Handler\Query
 */
class MetaHandler extends AbstractHandler implements MetaHandlerInterface
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param  MetaQuery|Query  $query
     */
    public function handle($query): void
    {
        // TODO: Implement handle() method.
    }
} 