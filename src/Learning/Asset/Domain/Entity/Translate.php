<?php


namespace Scandinaver\Learning\Asset\Domain\Entity;

use DateTime;
use Scandinaver\Common\Domain\Entity\Language;

/**
 * Class Translate
 *
 * @package Scandinaver\Learn\Domain\Entity
 */
class Translate
{
    private int $id;

    private string $value;

    private bool $sentence;

    private Term $term;

    private Language $language;

    private DateTime $createdAt;

    private ?DateTime $updatedAt;

    public function getValue(): string
    {
        return $this->value;
    }

    public function setValue(string $value): void
    {
        $this->value = $value;
    }

    public function setTerm(Term $term): void
    {
        $this->term = $term;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setSentence(int $sentence): void
    {
        $this->sentence = $sentence;
    }

    public function setLanguage(Language $language): void
    {
        $this->language = $language;
    }
}
