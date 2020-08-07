<?php


namespace Scandinaver\Common\UI\Command;

use Scandinaver\Shared\Contract\Command;

/**
 * Class DeleteMetaCommand
 *
 * @package Scandinaver\Common\UI\Command
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