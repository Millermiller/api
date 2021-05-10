<?php


namespace Scandinaver\User\UI\Command;

use Scandinaver\Shared\Contract\CommandInterface;
use Scandinaver\Shared\DTO;

/**
 * Class CreatePlanCommand
 *
 * @see     \Scandinaver\User\Application\Handler\Command\CreatePlanCommandHandler
 * @package Scandinaver\User\UI\Command
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