<?php


namespace Scandinaver\Reader\UI\Query;

use Scandinaver\Core\Domain\Attribute\Query;
use Scandinaver\Learning\Asset\Domain\Entity\Card;
use Scandinaver\Core\Domain\Contract\QueryInterface;
use Scandinaver\Reader\Application\Handler\Query\ReadCardQueryHandler;

/**
 * Class ReadCardQuery
 *
 * @package Scandinaver\Reader\UI\Query
 */
#[Query(ReadCardQueryHandler::class)]
class ReadCardQuery implements QueryInterface
{

    public function __construct(private Card $card)
    {
    }

    public function getCard(): Card
    {
        return $this->card;
    }
}