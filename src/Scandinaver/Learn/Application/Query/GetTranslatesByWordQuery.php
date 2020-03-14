<?php


namespace Scandinaver\Learn\Application\Query;

use Scandinaver\Learn\Domain\Word;
use Scandinaver\Shared\Contracts\Query;

/**
 * Class GetTranslatesByWordQuery
 * @package Scandinaver\Learn\Application\Query
 */
class GetTranslatesByWordQuery implements Query
{
    /**
     * @var Word
     */
    private $word;

    /**
     * GetTranslatesByWordQuery constructor.
     * @param Word $word
     */
    public function __construct(Word $word)
    {
        $this->word = $word;
    }

    /**
     * @return Word
     */
    public function getWord(): Word
    {
        return $this->word;
    }
}