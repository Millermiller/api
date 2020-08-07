<?php


namespace Scandinaver\Common\UI\Command;

use Scandinaver\Shared\Contract\Command;

/**
 * Class UpdateMetaCommand
 *
 * @package Scandinaver\Common\UI\Command
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