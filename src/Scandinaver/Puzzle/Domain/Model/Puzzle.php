<?php


namespace Scandinaver\Puzzle\Domain\Model;

use DateTime;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;
use Scandinaver\Puzzle\Domain\Events\PuzzleCreatedEvent;
use Scandinaver\Shared\Contract\AggregateRoot;
use Scandinaver\Shared\EventTrait;
use Scandinaver\User\Domain\Model\User;
use Doctrine\ORM\Mapping\{JoinTable, ManyToMany};
/**
 * Puzzles
 * @ORM\Table(name="puzzle")
 *
 * @ORM\Entity
 */
class Puzzle implements JsonSerializable, AggregateRoot
{
    use EventTrait;

    /**
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private int $id;

    /**
     * @ORM\Embedded(class="PuzzleText", columnPrefix = "text_")
     */
    private PuzzleText $text;

    /**
     * @ORM\Embedded(class="PuzzleTranslate", columnPrefix = "translate_")
     */
    private PuzzleTranslate $translate;

    /**
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private DateTime $createdAt;

    /**
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private ?DateTime $updatedAt;

    /**
     * @var Collection|User[]
     * @ORM\ManytoMany(targetEntity="Scandinaver\User\Domain\Model\User", mappedBy="puzzles")
     */
    private $users;

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'text' => $this->text,
            'translate' => $this->translate,
        ];
    }

    /**
     * @return User[]|Collection
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * @param User $user
     *
     * @return $this
     */
    public function addUser(User $user): Puzzle
    {
        $this->users[] = $user;

        return $this;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    public function getText()
    {
        return $this->text->toNative();
    }

    public function setText(PuzzleText $text): void
    {
        $this->text = $text;
    }
}
