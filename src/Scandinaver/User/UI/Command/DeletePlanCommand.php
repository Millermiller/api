<?php


namespace Scandinaver\User\UI\Command;

use Scandinaver\Shared\Contract\CommandInterface;
use Scandinaver\Shared\DTO;
use Scandinaver\User\Domain\Model\Plan;

/**
 * Class DeletePlanCommand
 *
 * @see     \Scandinaver\User\Application\Handler\Command\DeletePlanCommandHandler
 * @package Scandinaver\User\UI\Command
 */
class DeletePlanCommand implements CommandInterface
{

    private Plan $plan;

    public function __construct(Plan $plan)
    {
        $this->plan = $plan;
    }

    public function getPlan(): Plan
    {
        return $this->plan;
    }

    public function buildDTO(): DTO
    {
        // TODO: Implement buildDTO() method.
    }
}