<?php


namespace Scandinaver\Shared;

/**
 * Interface Handler
 * @package Scandinaver\Shared
 */
interface CommandHandler
{
    /**
     * @param Command $command
     */
    public function handle(Command $command): void;
}