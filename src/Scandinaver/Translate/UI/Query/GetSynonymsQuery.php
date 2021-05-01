<?php


namespace Scandinaver\Translate\UI\Query;

use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class GetSynonymsQuery
 *
 * @package Scandinaver\Translate\UI\Query
 *
 * @see     \Scandinaver\Translate\Application\Handler\Query\GetSynonymsQueryHandler
 */
class GetSynonymsQuery implements CommandInterface
{
    private int $word;

    public function __construct(int $word)
    {
        $this->word = $word;
    }
}