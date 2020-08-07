<?php


namespace Scandinaver\User\UI\Command;

use Scandinaver\Shared\Contract\Command;
use Scandinaver\User\Domain\Model\Plan;

/**
 * Class UpdatePlanCommand
 *
 * @see     \Scandinaver\User\Application\Handler\Command\UpdatePlanHandler
 * @package Scandinaver\User\UI\Command
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