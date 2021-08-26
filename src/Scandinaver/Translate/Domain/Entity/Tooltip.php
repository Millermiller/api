<?php


namespace Scandinaver\Translate\Domain\Entity;

use DateTime;

/**
 * Class Tooltip
 *
 * @package Scandinaver\Translate\Domain\Entity
 */
class Tooltip
{
    private ?int $id = NULL;

    private string $object;

    private string $value;

    private Text $text;

    private DateTime $createdAt;

    private ?DateTime $updatedAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getObject(): string
    {
        return $this->object;
    }

    public function setObject(string $object): void
    {
        $this->object = $object;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function setValue(string $value): void
    {
        $this->value = $value;
    }

    public function setText(Text $text): void
    {
        $this->text = $text;
    }

    public function getText(): Text
    {
        return $this->text;
    }
}
