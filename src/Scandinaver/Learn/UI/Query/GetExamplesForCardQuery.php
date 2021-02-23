<?php


namespace Scandinaver\Learn\UI\Query;

use Scandinaver\Shared\Contract\Query;

/**
 * Class GetExamplesForCardQuery
 *
 * @package Scandinaver\Learn\UI\Query
 *
 * @see     \Scandinaver\Learn\Application\Handler\Query\GetExamplesForCardHandler
 */
class GetExamplesForCardQuery implements Query
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