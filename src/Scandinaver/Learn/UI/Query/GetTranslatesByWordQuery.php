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
    private Word $word;

    public function __construct(Word $word)
    {
        $this->word = $word;
    }

    public function getWord(): Word
    {
        return $this->word;
    }
}