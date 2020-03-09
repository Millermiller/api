<?php


namespace Scandinaver\Common\Application\Commands;

use Scandinaver\Shared\Contracts\Command;

/**
 * Class DeleteMetaCommand
 * @package Scandinaver\Common\Application\Commands
 */
class DeleteMetaCommand implements Command
{
    private $meta;

    public function __construct($meta)
    {
        $this->meta = $meta;
    }

    /**
     * @return mixed
     */
    public function getMeta()
    {
        return $this->meta;
    }
}