<?php


namespace Scandinaver\Learn\UI\Query;

use Scandinaver\Learn\Domain\Model\Word;
use Scandinaver\Shared\Contract\Query;

/**
 * Class FindAudioQuery
 *
 * @see     \Scandinaver\Learn\Application\Handler\Query\FindAudioHandler
 * @package Scandinaver\Learn\UI\Query
 */
class FindAudioQuery implements Query
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