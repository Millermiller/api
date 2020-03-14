<?php


namespace Scandinaver\Learn\Application\Query;

use Scandinaver\Learn\Domain\Card;
use Scandinaver\Shared\Contracts\Query;

/**
 * Class GetExamplesForCardQuery
 * @package Scandinaver\Learn\Application\Query
 */
class GetExamplesForCardQuery implements Query
{
    /**
     * @var Card
     */
    private $card;

    /**
     * GetExamplesForCardQuery constructor.
     * @param Card $card
     */
    public function __construct(Card $card)
    {
        $this->card = $card;
    }

    /**
     * @return Card
     */
    public function getCard(): Card
    {
        return $this->card;
    }
}