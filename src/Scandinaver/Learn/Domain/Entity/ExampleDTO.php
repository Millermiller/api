<?php


namespace Scandinaver\Learn\Domain\Entity;

use Scandinaver\Shared\DTO;

/**
 * Class ExampleDTO
 *
 * @package Scandinaver\Learn\Domain\Entity
 */
class ExampleDTO extends DTO
{
    private ?int $id;
    private string $text;
    private string $value;
    private Card $card;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
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

    public function getCard(): Card
    {
        return $this->card;
    }

    public function setCard(Card $card): void
    {
        $this->card = $card;
    }

    public static function fromArray(array $data): ExampleDTO
    {
        $exampleDTO = new self();
        $exampleDTO->setId($data['id'] ?? NULL);
        $exampleDTO->setText($data['text']);
        $exampleDTO->setValue($data['value']);
        return $exampleDTO;
    }

}