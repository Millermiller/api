<?php


namespace Scandinaver\Core\Domain\Attribute;

use Attribute;

/**
 * Class Handler
 *
 * @package Scandinaver\Core\Domain\Attribute
 */
#[Attribute(Attribute::TARGET_CLASS)]
class Handler
{
    public function __construct(public string $handlerClass)
    {
    }
}