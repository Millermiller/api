<?php


namespace Scandinaver\Learn\Domain;

use Scandinaver\Common\Domain\Language;
use Scandinaver\User\Domain\User;
use DateTime;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;

/**
 * Words
 *
 * @ORM\Table(name="words", indexes={@ORM\Index(name="word", columns={"word"})})
 * @ORM\Entity
 */
class Word implements JsonSerializable
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
     * @ORM\Column(name="creator_id", type="integer", nullable=false)
     */
    private $creatorId;

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
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="Scandinaver\User\Domain\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="creator_id", referencedColumnName="id")
     * })
     */
    private $creator;

    /**
     * @var Language
     *
     * @ORM\ManyToOne(targetEntity="Scandinaver\Common\Domain\Language")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="language_id", referencedColumnName="id")
     * })
     */
    private $language;

    /**
     * @var string|null
     *
     * @ORM\Column(name="language_id", type="string", length=50, nullable=true)
     */
    private $languageId;

    /**
     * @var Collection|Result[]
     *
     * @ORM\OneToMany(targetEntity="Scandinaver\Learn\Domain\Card", mappedBy="word")
     *
     */
    private $cards;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return Result[]|Collection
     */
    public function getCards()
    {
        return $this->cards;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'word' => $this->word,
            'audio' => $this->audio,
            'sentence' => $this->sentence,
            'is_public' => $this->isPublic,
            'creator' => $this->creator,
            'language' => $this->language,
        ];
    }

    /**
     * @return string
     */
    public function getWord(): string
    {
        return $this->word;
    }

    /**
     * @return string|null
     */
    public function getAudio(): ?string
    {
        return $this->audio;
    }

    /**
     * @param string|null $audio
     */
    public function setAudio(?string $audio): void
    {
        $this->audio = $audio;
    }

    /**
     * @param string $word
     */
    public function setWord(string $word): void
    {
        $this->word = $word;
    }

    /**
     * @param int|null $sentence
     */
    public function setSentence(?int $sentence): void
    {
        $this->sentence = $sentence;
    }

    /**
     * @param int|null $isPublic
     */
    public function setIsPublic(?int $isPublic): void
    {
        $this->isPublic = $isPublic;
    }

    /**
     * @param User $creator
     */
    public function setCreator(User $creator): void
    {
        $this->creator = $creator;
    }

    /**
     * @param Language $language
     */
    public function setLanguage(Language $language): void
    {
        $this->language = $language;
    }
}
