<?php


namespace Scandinaver\Billing\UI\Command;

use Scandinaver\Shared\Contract\CommandInterface;
use Scandinaver\Shared\DTO;

/**
 * Class CreatePlanCommand
 *
 * @see     \Scandinaver\Billing\Application\Handler\Command\CreatePlanCommandHandler
 * @package Scandinaver\Billing\UI\Command
 */
class CreatePlanCommand implements CommandInterface
{

    private array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function buildDTO(): DTO
    {
        // TODO: Implement buildDTO() method.
    }
}