<?php

namespace  App\Entities;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;

/**
 * WordInText
 *
 * @ORM\Table(name="word_in_text", indexes={@ORM\Index(name="text_id", columns={"text_id", "sentence_num", "word"}), @ORM\Index(name="IDX_1B42EF50698D3548", columns={"text_id"})})
 * @ORM\Entity
 */
class WordInText implements JsonSerializable
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="sentence_num", type="integer", nullable=false)
     */
    private $sentenceNum;

    /**
     * @var string
     *
     * @ORM\Column(name="word", type="string", length=255, nullable=false)
     */
    private $word;

    /**
     * @var string
     *
     * @ORM\Column(name="orig", type="string", length=255, nullable=false)
     */
    private $orig;

    /**
     * @var DateTime|null
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @var DateTime|null
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @var Text
     *
     * @ORM\ManyToOne(targetEntity="Text")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="text_id", referencedColumnName="id")
     * })
     */
    private $text;

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'text_id' => $this->text->getId(),
            'sentence_num' => $this->sentenceNum,
            'word' => $this->word,
            'orig' => $this->orig,
        ];
    }
}
