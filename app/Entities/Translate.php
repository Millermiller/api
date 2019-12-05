<?php

namespace  App\Entities;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * Translate
 *
 * @ORM\Table(name="translate", indexes={@ORM\Index(name="word_id_2", columns={"word_id"}), @ORM\Index(name="word_id", columns={"word_id"}), @ORM\Index(name="fulltext", columns={"value"})})
 * @ORM\Entity
 */
class Translate
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
     * @var string
     *
     * @ORM\Column(name="value", type="string", length=255, nullable=false)
     */
    private $value;

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @var string|null
     *
     * @ORM\Column(name="variant", type="string", length=255, nullable=true)
     */
    private $variant;

    /**
     * @var int|null
     *
     * @ORM\Column(name="form", type="integer", nullable=true)
     */
    private $form;

    /**
     * @var int
     *
     * @ORM\Column(name="sentence", type="integer", nullable=false)
     */
    private $sentence = '0';

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
     * @var DateTime|null
     *
     * @ORM\Column(name="deleted_at", type="datetime", nullable=true)
     */
    private $deletedAt;

    /**
     * @var Word
     *
     * @ORM\ManyToOne(targetEntity="Word")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="word_id", referencedColumnName="id")
     * })
     */
    private $word;


}
