<?php


namespace Scandinaver\Learn\Domain\Model;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;

/**
 * Translate
 * @ORM\Table(name="translate", indexes={@ORM\Index(name="word_id_2", columns={"word_id"}), @ORM\Index(name="word_id", columns={"word_id"}), @ORM\Index(name="fulltext", columns={"value"})})
 *
 * @ORM\Entity
 */
class Translate implements JsonSerializable
{
    /**
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private int $id;

    /**
     * @ORM\Column(name="value", type="string", length=255, nullable=false)
     */
    private string $value;

    /**
     * @ORM\Column(name="sentence", type="integer", nullable=false)
     */
    private int $sentence;

    /**
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private DateTime $createdAt;

    /**
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private ?DateTime $updatedAt;

    /**
     * @ORM\ManyToOne(targetEntity="Scandinaver\Learn\Domain\Model\Word")
     * @ORM\JoinColumn(name="word_id", referencedColumnName="id")
     */
    private Word $word;

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param  string  $value
     */
    public function setValue(string $value): void
    {
        $this->value = $value;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'value' => $this->value,
            'word_id' => $this->word->getId(),
            'word' => $this->word,
            'sentence' => $this->sentence,
            'active' => $this->id,
        ];
    }

    /**
     * @param  Word  $word
     */
    public function setWord(Word $word): void
    {
        $this->word = $word;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
}
