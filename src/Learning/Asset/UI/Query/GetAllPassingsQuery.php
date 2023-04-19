<?php


namespace Scandinaver\Learning\Asset\UI\Query;

use Scandinaver\Core\Domain\Attribute\Handler;
use Scandinaver\Core\Domain\Contract\QueryInterface;
use Scandinaver\Core\Infrastructure\RequestParametersComposition;
use Scandinaver\Learning\Asset\Application\Handler\Query\GetAllPassingsQueryHandler;

/**
 * Class GetAllPassingsQuery
 *
 * @package Scandinaver\Learn\UI\Query
 */
#[Handler(GetAllPassingsQueryHandler::class)]
class GetAllPassingsQuery implements QueryInterface
{

    public function __construct(
        private readonly array                        $includes,
        private readonly RequestParametersComposition $parameters
    )
    {
    }

    public function getIncludes(): array
    {
        return $this->includes;
    }

    public function getParameters(): RequestParametersComposition
    {
        return $this->parameters;
    }

}