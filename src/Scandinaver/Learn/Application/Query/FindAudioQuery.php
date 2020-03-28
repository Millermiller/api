<?php


namespace Scandinaver\Learn\Application\Query;

use Scandinaver\Learn\Domain\Word;
use Scandinaver\Shared\Contracts\Query;

/**
 * Class FindAudioQuery
 * @package Scandinaver\Learn\Application\Query
 *
 * @see \Scandinaver\Learn\Application\Handlers\FindAudioHandler
 */
class FindAudioQuery implements Query
{
    /**
     * @var Word
     */
    private $word;

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