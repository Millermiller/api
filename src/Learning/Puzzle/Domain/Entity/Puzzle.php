<?php


namespace Scandinaver\Learning\Puzzle\Domain\Entity;

use DateTime;
use Scandinaver\Common\Domain\Contract\LearnItemInterface;
use Scandinaver\Common\Domain\Contract\UserInterface;
use Scandinaver\Common\Domain\Entity\HasLevel;
use Scandinaver\Common\Domain\Entity\Language;
use Scandinaver\Learning\Puzzle\Domain\Event\PuzzleCreated;
use Scandinaver\Shared\AggregateRoot;
use Scandinaver\Shared\EventTrait;

/**
 * Class Puzzle
 *
 * @package Scandinaver\Puzzle\Domain\Entity
 */
class Puzzle extends AggregateRoot implements LearnItemInterface
{
    use EventTrait;
    use HasLevel;

    private int $id;

    private PuzzleText $text;

    private PuzzleTranslate $translate;

    private DateTime $createdAt;

    private ?DateTime $updatedAt;

    private $users;

    private Language $language;

    public function __construct(PuzzleText $text, PuzzleTranslate $translate, Language $language)
    {
        $this->text      = $text;
        $this->translate = $translate;
        $this->language  = $language;

        $this->pushEvent(new PuzzleCreated($this));
    }

    /**
     * @return UserInterface[]
     */
    public function getUsers(): array
    {
        return $this->users;
    }

    public function addUser(UserInterface $user): Puzzle
    {
        $this->users[] = $user;

        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getText(): PuzzleText
    {
        return $this->text;
    }

    public function setText(PuzzleText $text): void
    {
        $this->text = $text;
    }


    public function getTranslate(): PuzzleTranslate
    {
        return $this->translate;
    }

    public function setTranslate(PuzzleTranslate $translate): void
    {
        $this->translate = $translate;
    }

    public function setLanguage(Language $language): void
    {
        $this->language = $language;
    }

    //todo: implement
    public function onDelete()
    {
        // $this->pushEvent(PuzzleDeleted($this));
    }

    public function getLanguage(): Language
    {
        return $this->language;
    }
}
