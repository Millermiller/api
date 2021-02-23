<?php


namespace Scandinaver\Learn\UI\Query;

use Scandinaver\Shared\Contract\Query;

/**
 * Class GetTranslatesByWordQuery
 *
 * @package Scandinaver\Learn\UI\Query
 *
 * @see     \Scandinaver\Learn\Application\Handler\Query\GetTranslatesByWordHandler
 */
class GetTranslatesByWordQuery implements Query
{
    private int $word;

    public function __construct(int $word)
    {
        $this->word = $word;
    }

    public function getWord(): int
    {
        return $this->word;
    }
}