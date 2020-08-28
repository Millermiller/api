<?php


namespace Scandinaver\Learn\UI\Query;

use Scandinaver\Learn\Domain\Model\Card;
use Scandinaver\Shared\Contract\Query;

/**
 * Class GetExamplesForCardQuery
 *
 * @see     \Scandinaver\Learn\Application\Handler\Query\GetExamplesForCardHandler
 * @package Scandinaver\Learn\UI\Query
 */
class GetExamplesForCardQuery implements Query
{
    private Card $card;

    public function __construct(Card $card)
    {
        $this->card = $card;
    }

    public function getCard(): Card
    {
        return $this->card;
    }
}