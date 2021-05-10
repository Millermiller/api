<?php


namespace Scandinaver\Reader\UI\Query;

use Scandinaver\Learn\Domain\Model\Card;
use Scandinaver\Shared\Contract\QueryInterface;

/**
 * Class ReadCardQuery
 *
 * @package Scandinaver\Reader\UI\Query
 *
 * @see     \Scandinaver\Reader\Application\Handler\Query\ReadCardQueryHandler
 */
class ReadCardQuery implements QueryInterface
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