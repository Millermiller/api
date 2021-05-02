<?php


namespace Scandinaver\Learn\Domain\Event;

use Scandinaver\Learn\Domain\Model\Word;
use Scandinaver\Shared\DomainEvent;

/**
 * Class WordUpdated
 *
 * @package Scandinaver\Learn\Domain\Event
 */
class WordUpdated implements DomainEvent
{

    private Word $word;

    private string $value;

    public function __construct(Word $word, string $value)
    {
        $this->word  = $word;
        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function getWord(): Word
    {
        return $this->word;
    }
}