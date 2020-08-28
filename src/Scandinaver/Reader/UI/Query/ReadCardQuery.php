<?php


namespace Scandinaver\Reader\UI\Query;

use Scandinaver\Learn\Domain\Model\Card;
use Scandinaver\Shared\Contract\Query;

/**
 * Class ReadCardQuery
 *
 * @package Scandinaver\Reader\UI\Query
 *
 * @see \Scandinaver\Reader\Application\Handler\Query\ReadCardHandler
 */
class ReadCardQuery implements Query
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