<?php


namespace Scandinaver\Learning\Asset\Domain\Event;

use Scandinaver\Learning\Asset\Domain\Entity\Translate;
use Scandinaver\Core\Domain\Contract\DomainEvent;

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