<?php


namespace Scandinaver\User\Application\Handler\Query;

use Scandinaver\User\Domain\Contract\Query\PlansHandlerInterface;
use Scandinaver\User\UI\Query\PlansQuery;

/**
 * Class PlansHandler
 *
 * @package Scandinaver\User\Application\Handler\Query
 */
class PlansHandler implements PlansHandlerInterface
{
    public function __construct()
    {

    }

    /**
     * @param  PlansQuery
     *
     * @inheritDoc
     */
    public function handle($query)
    {
        // TODO: Implement handle() method.
    }
} 