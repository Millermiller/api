<?php


namespace Scandinaver\Common\Domain\Event;

use Scandinaver\Common\Domain\Entity\Language;
use Scandinaver\Shared\DomainEvent;

/**
 * Class LanguageCreated
 *
 * @package Scandinaver\Common\Domain\Event
 *
 */
class LanguageCreated implements DomainEvent
{
    private Language $language;

    public function __construct(Language $language)
    {
        $this->language = $language;
    }

    public function getLanguage(): Language
    {
        return $this->language;
    }
}