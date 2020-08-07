<?php


namespace Scandinaver\Learn\Domain\Model;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;

/**
 * Examples
 * @ORM\Table(name="example", indexes={@ORM\Index(name="card_id", columns={"card_id"})})
 *
 * @ORM\Entity
 */
class Example implements JsonSerializable
{
    /**
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private int $id;

    /**
     * @ORM\Column(name="text", type="text", length=65535, nullable=false)
     */
    private string $text;

    /**
     * @ORM\Column(name="value", type="text", length=65535, nullable=false)
     */
    private string $value;

    /**
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private DateTime $createdAt;

    /**
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private ?DateTime $updatedAt;

    /**
     * @var Card
     * @ORM\ManyToOne(targetEntity="Scandinaver\Learn\Domain\Model\Card", inversedBy="examples")
     * @ORM\JoinColumn(name="card_id", referencedColumnName="id")
     */
    private Card $card;

    /**
     * Example constructor.
     *
     * @param  string  $text
     * @param  string  $value
     * @param  Card    $card
     */
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

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'card_id' => $this->card->getId(),
            'text' => $this->text,
            'value' => $this->value,
        ];
    }
}
