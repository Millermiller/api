<?php


namespace Scandinaver\Shared\Contract;

/**
 * Interface CommandHandler
 *
 * @package Scandinaver\Shared\Contract
 */
interface CommandHandler
{

    /**
     * @param Command  $command
     *
     * @return mixed
     */
    public function handle(Command $command);
}