<?php


namespace Scandinaver\Learn\Domain\Model;

use DateTime;

/**
 * Class Example
 *
 * @package Scandinaver\Learn\Domain\Model
 */
class Example
{
    private int $id;

    private string $text;

    private string $value;

    private DateTime $createdAt;

    private ?DateTime $updatedAt;

    private Card $card;

    public function __construct(string $text, string $value, Card $card)
    {
        $this->setText($text);
        $this->setValue($value);
        $this->setCard($card);
    }

    public function setUpdatedAt(?DateTime $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): void
    {
        $this->text = $text;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function setValue(string $value): void
    {
        $this->value = $value;
    }

    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }

    public function getCard(): Card
    {
        return $this->card;
    }

    public function setCard(Card $card): void
    {
        $this->card = $card;
    }

    public function toDTO(): ExampleDTO
    {
        return new ExampleDTO($this);
    }
}
