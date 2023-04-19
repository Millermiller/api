<?php


namespace Scandinaver\Learning\Asset\UI\Query;

use JetBrains\PhpStorm\Pure;
use Scandinaver\Core\Domain\Attribute\Handler;
use Scandinaver\Core\Domain\Contract\QueryInterface;
use Scandinaver\Core\Domain\Contract\UserInterface;
use Scandinaver\Core\Domain\FilteringQuery;
use Scandinaver\Core\Infrastructure\RequestParametersComposition;
use Scandinaver\Learning\Asset\Application\Handler\Query\AssetsQueryHandler;

/**
 * Class AssetsQuery
 *
 * @package Scandinaver\Learn\UI\Query
 */
#[Handler(AssetsQueryHandler::class)]
class AssetsQuery extends FilteringQuery implements QueryInterface
{

    #[Pure]
    public function __construct(RequestParametersComposition $parameters, private UserInterface $user)
    {
        parent::__construct($parameters);
    }

    public function getUser(): UserInterface
    {
        return $this->user;
    }
}