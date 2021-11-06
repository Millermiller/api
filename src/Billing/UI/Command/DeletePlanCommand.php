<?php


namespace Scandinaver\Billing\UI\Command;

use Scandinaver\Shared\Contract\CommandInterface;
use Scandinaver\Shared\DTO;

/**
 * Class DeletePlanCommand
 *
 * @see     \Scandinaver\Billing\Application\Handler\Command\DeletePlanCommandHandler
 * @package Scandinaver\Billing\UI\Command
 */
class DeletePlanCommand implements CommandInterface
{

    private int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
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