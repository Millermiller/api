<?php


namespace Scandinaver\Common\Application\Handler\Query;

use Scandinaver\Common\UI\Query\MetasQuery;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class MetasQueryHandler
 *
 * @package Scandinaver\Common\Application\Handler\Query
 */
class MetasQueryHandler extends AbstractHandler
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param  MetasQuery|CommandInterface  $query
     */
    public function handle(CommandInterface $query): void
    {
        // TODO: Implement handle() method.
    }
} 