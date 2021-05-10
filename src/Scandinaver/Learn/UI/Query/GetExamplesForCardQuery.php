<?php


namespace Scandinaver\Learn\UI\Query;

use Scandinaver\Shared\Contract\QueryInterface;

/**
 * Class GetExamplesForCardQuery
 *
 * @package Scandinaver\Learn\UI\Query
 *
 * @see     \Scandinaver\Learn\Application\Handler\Query\GetExamplesForCardQueryHandler
 */
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