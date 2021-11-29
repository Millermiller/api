<?php


namespace Scandinaver\Core\Domain\Attribute;

use Attribute;

/**
 * Class CommandFor
 *
 * @package Scandinaver\User\UI\Command
 */
#[Attribute(Attribute::TARGET_CLASS)]
class Command
{
    public function __construct(public string $commandHandlerClass)
    {
    }
}