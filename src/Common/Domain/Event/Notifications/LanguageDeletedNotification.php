<?php


namespace Scandinaver\Common\Domain\Event\Notifications;


use Scandinaver\Common\Domain\Entity\Language;
use Scandinaver\Core\Infrastructure\CrossDomainEvent;

/**
 * Class LanguageDeletedNotification
 *
 * @package Scandinaver\Common\Domain\Event\Notifications
 */
class LanguageDeletedNotification extends CrossDomainEvent
{
    public function __construct(private Language $language)
    {
    }

    public function getLanguage(): Language
    {
        return $this->language;
    }
}