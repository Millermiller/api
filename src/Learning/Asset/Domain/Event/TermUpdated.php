<?php


namespace Scandinaver\Learning\Asset\Domain\Event;

use Scandinaver\Learning\Asset\Domain\Entity\Term;
use Scandinaver\Shared\DomainEvent;

/**
 * Class TermUpdated
 *
 * @package Scandinaver\Learn\Domain\Event
 */
class TermUpdated implements DomainEvent
{

    private Term $term;

    private string $value;

    public function __construct(Term $term, string $value)
    {
        $this->term  = $term;
        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function getTerm(): Term
    {
        return $this->term;
    }
}