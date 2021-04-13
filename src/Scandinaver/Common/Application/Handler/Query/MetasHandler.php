<?php


namespace Scandinaver\Common\Application\Handler\Query;

use Scandinaver\Common\Domain\Contract\Query\MetasHandlerInterface;
use Scandinaver\Common\UI\Query\MetasQuery;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\Query;

/**
 * Class MetasHandler
 *
 * @package Scandinaver\Common\Application\Handler\Query
 */
class MetasHandler extends AbstractHandler implements MetasHandlerInterface
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param  MetasQuery|Query  $query
     */
    public function handle($query): void
    {
        // TODO: Implement handle() method.
    }
} 