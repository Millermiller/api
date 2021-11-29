<?php


namespace Scandinaver\Core\Domain\Attribute;

use Attribute;

/**
 * Class CommandFor
 *
 * @package Scandinaver\User\UI\Command
 */
#[Attribute(Attribute::TARGET_CLASS)]
class Query
{
    public function __construct(public string $queryHandlerClass)
    {
    }
}