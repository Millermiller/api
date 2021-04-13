<?php


namespace Scandinaver\User\Application\Handler\Query;

use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\Query;
use Scandinaver\User\Domain\Contract\Query\PlansHandlerInterface;
use Scandinaver\User\UI\Query\PlansQuery;

/**
 * Class PlansHandler
 *
 * @package Scandinaver\User\Application\Handler\Query
 */
class PlansHandler extends AbstractHandler implements PlansHandlerInterface
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param  PlansQuery|Query  $query
     */
    public function handle($query): void
    {
        // TODO: Implement handle() method.
    }
} 