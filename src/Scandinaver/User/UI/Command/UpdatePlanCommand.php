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
    private Plan $plan;

    private array $data;

    public function __construct(Plan $plan, array $data)
    {
        $this->plan = $plan;
        $this->data = $data;
    }

    public function getPlan(): Plan
    {
        return $this->plan;
    }

    public function getData(): array
    {
        return $this->data;
    }
}