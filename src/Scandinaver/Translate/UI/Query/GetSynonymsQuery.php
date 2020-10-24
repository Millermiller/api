<?php


namespace Scandinaver\Translate\UI\Query;

use Scandinaver\Shared\Contract\Query;

/**
 * Class GetSynonymsQuery
 *
 * @package Scandinaver\Translate\UI\Query
 *
 * @see     \Scandinaver\Translate\Application\Handler\Query\GetSynonymsHandler
 */
class GetSynonymsQuery implements Query
{
    private int $word;

    public function __construct(int $word)
    {
        $this->word = $word;
    }
}