<?php


namespace Scandinaver\Learn\Domain\Event;

use Scandinaver\Learn\Domain\Model\Translate;
use Scandinaver\Shared\DomainEvent;

/**
 * Class TranslateUpdated
 *
 * @package Scandinaver\Learn\Domain\Event
 */
class TranslateUpdated implements DomainEvent
{

    private Translate $translate;

    private string $value;

    public function __construct(Translate $translate, string $value)
    {
        $this->translate = $translate;
        $this->value     = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function getTranslate(): Translate
    {
        return $this->translate;
    }
}