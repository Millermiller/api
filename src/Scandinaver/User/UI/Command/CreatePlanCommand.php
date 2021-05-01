<?php


namespace Scandinaver\User\UI\Command;

use Scandinaver\Shared\Contract\CommandInterface;

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
}