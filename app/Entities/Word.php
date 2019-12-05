<?php

namespace  App\Entities;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * Words
 *
 * @ORM\Table(name="words", indexes={@ORM\Index(name="word", columns={"word"})})
 * @ORM\Entity
 */
class Word
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
     * @ORM\Column(name="word", type="string", length=255, nullable=false)
     */
    private $word;

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->word;
    }

    /**
     * @var string|null
     *
     * @ORM\Column(name="transcription", type="string", length=255, nullable=true)
     */
    private $transcription;

    /**
     * @var string|null
     *
     * @ORM\Column(name="audio", type="string", length=255, nullable=true)
     */
    private $audio;

    /**
     * @var int|null
     *
     * @ORM\Column(name="sentence", type="integer", nullable=true)
     */
    private $sentence = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="is_public", type="integer", nullable=true)
     */
    private $isPublic = '0';

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
     * @var int|null
     *
     * @ORM\Column(name="creator", type="integer", nullable=true)
     */
    private $creator;

    /**
     * @var string|null
     *
     * @ORM\Column(name="lang", type="string", length=50, nullable=true)
     */
    private $lang;


}
