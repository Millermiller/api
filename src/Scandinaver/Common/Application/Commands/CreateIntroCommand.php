<?php


namespace Scandinaver\Common\Application\Commands;

use Scandinaver\Shared\Contracts\Command;

/**
 * Class CreateIntroCommand
 *
 * @package Scandinaver\Common\Application\Commands
 */
class CreateIntroCommand implements Command
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