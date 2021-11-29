<?php


namespace Scandinaver\User\UI\Query;

use Scandinaver\Core\Domain\Attribute\Query;
use Scandinaver\Core\Domain\Contract\QueryInterface;
use Scandinaver\Core\Infrastructure\RequestParametersComposition;
use Scandinaver\User\Application\Handler\Query\UsersQueryHandler;

/**
 * Class UsersQuery
 *
 * @package Scandinaver\User\UI\Query
 */
#[Query(UsersQueryHandler::class)]
class UsersQuery implements QueryInterface
{

    public function __construct(private array $includes, private RequestParametersComposition $parameters)
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