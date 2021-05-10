<?php


namespace Scandinaver\User\Application\Handler\Query;

use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\BaseCommandInterface;
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
     * @param  PlansQuery|BaseCommandInterface  $query
     */
    public function handle(BaseCommandInterface $query): void
    {
        // TODO: Implement handle() method.
    }
} 