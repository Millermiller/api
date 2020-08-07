<?php


namespace Scandinaver\Puzzle\Domain\Model;

use DateTime;
use JsonSerializable;
use Scandinaver\Puzzle\Domain\Events\PuzzleCreatedEvent;
use Scandinaver\Shared\Contract\AggregateRoot;
use Scandinaver\Shared\EventTrait;
use Scandinaver\User\Domain\Model\User;

/**
 * Class Puzzle
 *
 * @package Scandinaver\Puzzle\Domain\Model
 */
class Puzzle implements JsonSerializable, AggregateRoot
{
    use EventTrait;

    private int $id;

    private PuzzleText $text;

    private PuzzleTranslate $translate;

    private DateTime $createdAt;

    private ?DateTime $updatedAt;

    private $users;

    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'text' => $this->text,
            'translate' => $this->translate,
        ];
    }

    /**
     * @return User[]
     */
    public function getUsers(): array
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

    public function getId(): int
    {
        return $this->id;
    }

    public function getText(): string
    {
        return $this->text->toNative();
    }

    public function setText(PuzzleText $text): void
    {
        $this->text = $text;
    }
}
