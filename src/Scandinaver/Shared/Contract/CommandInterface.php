<?php


namespace Scandinaver\Shared\Contract;

use Scandinaver\Shared\DTO;

/**
 * Interface CommandInterface
 *
 * @package Scandinaver\Shared\Contract
 */
interface CommandInterface extends BaseCommandInterface
{

    public function buildDTO(): DTO;
}