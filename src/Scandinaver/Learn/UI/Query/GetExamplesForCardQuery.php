<?php


namespace Scandinaver\Learn\UI\Query;

use Scandinaver\Shared\Contract\Query;

/**
 * Class GetExamplesForCardQuery
 *
 * @see     \Scandinaver\Learn\Application\Handler\Query\GetExamplesForCardHandler
 * @package Scandinaver\Learn\UI\Query
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