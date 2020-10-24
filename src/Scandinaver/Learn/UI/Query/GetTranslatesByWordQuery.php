<?php


namespace Scandinaver\Learn\UI\Query;

use Scandinaver\Learn\Domain\Model\Word;
use Scandinaver\Shared\Contract\Query;

/**
 * Class GetTranslatesByWordQuery
 *
 * @see     \Scandinaver\Learn\Application\Handler\Query\GetTranslatesByWordHandler
 * @package Scandinaver\Learn\UI\Query
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