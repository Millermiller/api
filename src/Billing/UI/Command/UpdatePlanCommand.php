<?php


namespace Scandinaver\Billing\UI\Command;

use Scandinaver\Shared\Contract\CommandInterface;
use Scandinaver\Shared\DTO;
use Scandinaver\Billing\Domain\Entity\Plan;

/**
 * Class UpdatePlanCommand
 *
 * @see     \Scandinaver\Billing\Application\Handler\Command\UpdatePlanCommandHandler
 * @package Scandinaver\Billing\UI\Command
 */
class UpdatePlanCommand implements CommandInterface
{

    private Plan $plan;

    private array $data;
    private int $id;

    public function __construct(int $id, array $data)
    {
        $this->data = $data;
        $this->id = $id;
    }

    public function getPlan(): Plan
    {
        return $this->plan;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function buildDTO(): DTO
    {
        // TODO: Implement buildDTO() method.
    }

    public function getId(): int
    {
        return $this->id;
    }
}