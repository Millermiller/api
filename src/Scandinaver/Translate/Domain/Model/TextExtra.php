<?php


namespace Scandinaver\Translate\Domain\Model;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;

/**
 * TextExtras
 * @ORM\Table(name="text_extra", indexes={@ORM\Index(name="text_id", columns={"text_id", "orig", "extra"}), @ORM\Index(name="IDX_3317FC22698D3548", columns={"text_id"})})
 *
 * @ORM\Entity
 */
class TextExtra implements JsonSerializable
{
    /**
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private int $id;

    /**
     * @ORM\Column(name="orig", type="string", length=255, nullable=false)
     */
    private string $orig;

    /**
     * @ORM\Column(name="extra", type="string", length=255, nullable=false)
     */
    private string $extra;

    /**
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private DateTime $createdAt;

    /**
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private ?DateTime $updatedAt;

    /**
     * @ORM\ManyToOne(targetEntity="Text", inversedBy="extra")
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
            'orig' => $this->orig,
            'extra' => $this->extra,
        ];
    }
}
