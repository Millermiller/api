<?php


namespace Scandinaver\Learn\UI\Query;

use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class GetExamplesForCardQuery
 *
 * @package Scandinaver\Learn\UI\Query
 *
 * @see     \Scandinaver\Learn\Application\Handler\Query\GetExamplesForCardQueryHandler
 */
class GetExamplesForCardQuery implements CommandInterface
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