<?php


namespace Scandinaver\Shared\Contracts;

/**
 * Interface CommandHandler
 *
 * @package Scandinaver\Shared\Contracts
 */
interface CommandHandler
{
    /**
     * @param Command $command
     */
    public function handle(Command $command);
}