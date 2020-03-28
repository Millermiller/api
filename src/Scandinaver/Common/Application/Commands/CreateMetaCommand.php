<?php


namespace Scandinaver\Common\Application\Commands;

use Scandinaver\Shared\Contracts\Command;

/**
 * Class CreateMetaCommand
 *
 * @package Scandinaver\Common\Application\Commands
 */
class CreateMetaCommand implements Command
{
    /**
     * @var array
     */
    public $data;

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