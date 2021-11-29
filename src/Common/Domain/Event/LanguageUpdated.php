<?php


namespace Scandinaver\Common\Domain\Event;

use Scandinaver\Common\Domain\Entity\Language;
use Scandinaver\Core\Domain\Contract\DomainEvent;

/**
 * Class LanguageUpdated
 *
 * @package Scandinaver\Common\Domain\Event
 *
 */
class LanguageUpdated implements DomainEvent
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