<?php


namespace Scandinaver\User\Application\Commands;

use Scandinaver\Shared\Contracts\Command;
use Scandinaver\User\Domain\Plan;

/**
 * Class DeletePlanCommand
 *
 * @package Scandinaver\User\Application\Commands
 * @see     \Scandinaver\User\Application\Handlers\DeletePlanHandler
 */
class DeletePlanCommand implements Command
{
    /**
     * @var Plan
     */
    private $plan;

    public function __construct(Plan $plan)
    {
        $this->plan = $plan;
    }

    /**
     * @return Plan
     */
    public function getPlan(): Plan
    {
        return $this->plan;
    }
}