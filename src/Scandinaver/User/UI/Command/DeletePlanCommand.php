<?php


namespace Scandinaver\User\UI\Command;

use Scandinaver\Shared\Contract\Command;
use Scandinaver\User\Domain\Model\Plan;

/**
 * Class DeletePlanCommand
 *
 * @see     \Scandinaver\User\Application\Handler\Command\DeletePlanHandler
 * @package Scandinaver\User\UI\Command
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