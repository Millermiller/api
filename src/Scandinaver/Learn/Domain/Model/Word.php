<?php


namespace Scandinaver\Learn\Domain\Model;

use DateTime;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;
use LaravelDoctrine\ORM\Contracts\UrlRoutable;
use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\User\Domain\Model\User;

/**
 * Words
 * @ORM\Table(name="word", indexes={@ORM\Index(name="word", columns={"word"})})
 *
 * @ORM\Entity
 */
class Word implements JsonSerializable, UrlRoutable
{
    /**
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private int $id;

    /**
     * @ORM\Column(name="word", type="string", length=255, nullable=false)
     */
    private string $word;

    /**
     * @ORM\Column(name="audio", type="string", length=255, nullable=true)
     */
    private ?string $audio;

    /**
     * @ORM\Column(name="sentence", type="integer", nullable=true)
     */
    private ?int $sentence;

    /**
     * @ORM\Column(name="is_public", type="integer", nullable=false)
     */
    private int $isPublic;

    /**
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private DateTime $createdAt;

    /**
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private ?DateTime $updatedAt;

    /**
     * @ORM\ManyToOne(targetEntity="Scandinaver\User\Domain\Model\User", fetch="LAZY")
     * @ORM\JoinColumn(name="creator_id", referencedColumnName="id")
     */
    private $creator;

    /**
     * @ORM\ManyToOne(targetEntity="Scandinaver\Common\Domain\Model\Language", fetch="LAZY")
     * @ORM\JoinColumn(name="language_id", referencedColumnName="id")
     */
    private Language $language;

    /**
     * @var Collection|Result[]
     * @ORM\OneToMany(targetEntity="Scandinaver\Learn\Domain\Model\Card", mappedBy="word",
     *   fetch="LAZY")
     */
    private Collection $cards;

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->word;
    }

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

    public function getWord(): string
    {
        return $this->word;
    }


    public function setWord(string $word): void
    {
        $this->word = $word;
    }

    public function getAudio(): ?string
    {
        return $this->audio;
    }

    public function setAudio(?string $audio): void
    {
        $this->audio = $audio;
    }

    public function setSentence(?int $sentence): void
    {
        $this->sentence = $sentence;
    }

    public function setIsPublic(int $isPublic): void
    {
        $this->isPublic = $isPublic;
    }

    public function setCreator(User $creator): void
    {
        $this->creator = $creator;
    }

    public function setLanguage(Language $language): void
    {
        $this->language = $language;
    }

    public static function getRouteKeyName(): string
    {
        return 'id';
    }
}
