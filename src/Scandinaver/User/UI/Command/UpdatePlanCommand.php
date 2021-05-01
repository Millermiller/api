<?php


namespace Scandinaver\User\UI\Command;

use Scandinaver\Shared\Contract\CommandInterface;
use Scandinaver\User\Domain\Model\Plan;

/**
 * Class UpdatePlanCommand
 *
 * @see     \Scandinaver\User\Application\Handler\Command\UpdatePlanCommandHandler
 * @package Scandinaver\User\UI\Command
 */
class UpdatePlanCommand implements CommandInterface
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