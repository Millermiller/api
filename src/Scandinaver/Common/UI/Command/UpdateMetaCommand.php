<?php


namespace Scandinaver\Common\UI\Command;

use Scandinaver\Shared\Contract\CommandInterface;
use Scandinaver\Shared\DTO;

/**
 * Class UpdateMetaCommand
 *
 * @package Scandinaver\Common\UI\Command
 */
class UpdateMetaCommand implements CommandInterface
{

    private $meta;

    private array $data;

    /**
     * UpdateMetaCommand constructor.
     *
     * @param $meta
     * @param $data
     */
    public function __construct($meta, $data)
    {
        $this->meta = $meta;
        $this->data = $data;
    }

    public function getMeta()
    {
        return $this->meta;
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