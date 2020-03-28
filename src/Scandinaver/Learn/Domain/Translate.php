<?php


namespace Scandinaver\Learn\Domain;

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
     * @var int
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int
     * @ORM\Column(name="word_id", type="integer", nullable=false)
     */
    private $wordId;

    /**
     * @var string
     * @ORM\Column(name="value", type="string", length=255, nullable=false)
     */
    private $value;

    /**
     * @var string|null
     * @ORM\Column(name="variant", type="string", length=255, nullable=true)
     */
    private $variant;

    /**
     * @var int|null
     * @ORM\Column(name="form", type="integer", nullable=true)
     */
    private $form;

    /**
     * @var int
     * @ORM\Column(name="sentence", type="integer", nullable=false)
     */
    private $sentence = '0';

    /**
     * @var DateTime|null
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @var DateTime|null
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @var DateTime|null
     * @ORM\Column(name="deleted_at", type="datetime", nullable=true)
     */
    private $deletedAt;

    /**
     * @var Word
     * @ORM\ManyToOne(targetEntity="Scandinaver\Learn\Domain\Word")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="word_id", referencedColumnName="id")
     * })
     */
    private $word;

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param string $value
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
            'id'       => $this->id,
            'value'    => $this->value,
            'word_id'  => $this->wordId,
            'word'     => $this->word,
            'sentence' => $this->sentence,
            'active'   => $this->id,
        ];
    }

    /**
     * @return int
     */
    public function getWordId(): int
    {
        return $this->wordId;
    }

    /**
     * @param Word $word
     */
    public function setWord(Word $word): void
    {
        $this->word = $word;
    }
}
