<?php


namespace Scandinaver\Translate\Domain\Model;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;

/**
 * WordInText
 * @ORM\Table(name="word_in_text", indexes={@ORM\Index(name="text_id", columns={"text_id", "sentence_num", "word"}), @ORM\Index(name="IDX_1B42EF50698D3548", columns={"text_id"})})
 *
 * @ORM\Entity
 */
class Word implements JsonSerializable
{

    /**
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private int $id;

    /**
     * @ORM\Column(name="sentence_num", type="integer", nullable=false)
     */
    private int $sentenceNum;

    /**
     * @ORM\Column(name="word", type="string", length=255, nullable=false)
     */
    private string $word;

    /**
     * @ORM\Column(name="orig", type="string", length=255, nullable=false)
     */
    private string $orig;

    /**
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private DateTime $createdAt;

    /**
     * @ORM\Column(name="updated_at", type="datetime", nullable=false)
     */
    private ?DateTime $updatedAt;

    /**
     * @var Text
     * @ORM\ManyToOne(targetEntity="Scandinaver\Translate\Domain\Model\Text", inversedBy="words")
     * @ORM\JoinColumn(name="text_id", referencedColumnName="id")
     */
    private Text $text;

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
