<?php


namespace Scandinaver\Common\UI\Command;

use Scandinaver\Core\Domain\Contract\CommandInterface;
use Scandinaver\Core\Domain\DTO;

/**
 * Class DeleteMetaCommand
 *
 * @package Scandinaver\Common\UI\Command
 */
class DeleteMetaCommand implements CommandInterface
{

    private $meta;

    /**
     * DeleteMetaCommand constructor.
     *
     * @param $meta
     */
    public function __construct($meta)
    {
        $this->meta = $meta;
    }

    public function getMeta()
    {
        return $this->meta;
    }

    public function buildDTO(): DTO
    {
        // TODO: Implement buildDTO() method.
    }
}