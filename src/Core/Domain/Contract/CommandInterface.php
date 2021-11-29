<?php


namespace Scandinaver\Core\Domain\Contract;

use Scandinaver\Core\Domain\DTO;

/**
 * Interface CommandInterface
 *
 * @package Scandinaver\Core\Domain\Contract
 */
interface CommandInterface extends BaseCommandInterface
{

    public function buildDTO(): DTO;
}