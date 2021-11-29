<?php


namespace Scandinaver\Learning\Asset\UI\Query;

use Scandinaver\Core\Domain\Attribute\Query;
use Scandinaver\Core\Domain\Contract\QueryInterface;
use Scandinaver\Learning\Asset\Application\Handler\Query\GetExamplesForCardQueryHandler;

/**
 * Class GetExamplesForCardQuery
 *
 * @package Scandinaver\Learn\UI\Query
 */
#[Query(GetExamplesForCardQueryHandler::class)]
class GetExamplesForCardQuery implements QueryInterface
{

    private int $card;

    public function __construct(int $card)
    {
        $this->card = $card;
    }

    public function getCard(): int
    {
        return $this->card;
    }
}