<?php


namespace Scandinaver\Shared\Contract;

/**
 * Interface CommandHandler
 *
 * @package Scandinaver\Shared\Contract
 */
interface CommandHandler
{
    public function handle(Command $command);
}