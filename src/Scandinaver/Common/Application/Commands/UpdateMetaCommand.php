<?php


namespace Scandinaver\Common\Application\Commands;

use Scandinaver\Shared\Contracts\Command;

/**
 * Class UpdateMetaCommand
 * @package Scandinaver\Common\Application\Commands
 */
class UpdateMetaCommand implements Command
{
    private $meta;

    /**
     * @var array
     */
    private $data;

    public function __construct($meta, $data)
    {
        $this->meta = $meta;
        $this->data = $data;
    }

    /**
     * @return mixed
     */
    public function getMeta()
    {
        return $this->meta;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }
}