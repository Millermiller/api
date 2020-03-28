<?php


namespace Scandinaver\User\Application\Commands;

use Scandinaver\Shared\Contracts\Command;
use Scandinaver\User\Domain\Plan;

/**
 * Class UpdatePlanCommand
 *
 * @package Scandinaver\User\Application\Commands
 * @see     \Scandinaver\User\Application\Handlers\UpdatePlanHandler
 */
class UpdatePlanCommand implements Command
{
    /**
     * @var Plan
     */
    private $plan;

    /**
     * @var array
     */
    private $data;

    public function __construct(Plan $plan, array $data)
    {
        $this->plan = $plan;
        $this->data = $data;
    }

    /**
     * @return Plan
     */
    public function getPlan(): Plan
    {
        return $this->plan;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }
}