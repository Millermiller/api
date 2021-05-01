<?php


namespace Scandinaver\User\Application\Handler\Query;

use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\CommandInterface;
use Scandinaver\User\UI\Query\PlansQuery;

/**
 * Class PlansQueryHandler
 *
 * @package Scandinaver\User\Application\Handler\Query
 */
class PlansQueryHandler extends AbstractHandler
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param  PlansQuery|CommandInterface  $query
     */
    public function handle(CommandInterface $query): void
    {
        // TODO: Implement handle() method.
    }
} 