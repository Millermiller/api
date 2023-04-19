<?php


namespace Scandinaver\Core\Domain;

use Scandinaver\Core\Infrastructure\RequestParametersComposition;

/**
 * Class FilteringQuery
 *
 * @package Scandinaver\Core\Domain
 */
class FilteringQuery
{
    public function __construct(private readonly RequestParametersComposition $parameters)
    {
    }

    public function getParameters(): RequestParametersComposition
    {
        return $this->parameters;
    }
}