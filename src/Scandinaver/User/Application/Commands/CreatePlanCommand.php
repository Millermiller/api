<?php


namespace Scandinaver\User\Application\Commands;

use Scandinaver\Shared\Contracts\Command;

/**
 * Class CreatePlanCommand
 * @package Scandinaver\User\Application\Commands
 *
 * @see \Scandinaver\User\Application\Handlers\CreatePlanHandler
 */
class CreatePlanCommand implements Command
{
    /**
     * @var array
     */
    private $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }
}