<?php


namespace Scandinaver\Puzzle\Domain\Model;

use DateTime;
use Scandinaver\Common\Domain\Contract\UserInterface;
use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\Puzzle\Domain\Events\PuzzleCreated;
use Scandinaver\Shared\AggregateRoot;
use Scandinaver\Shared\EventTrait;

/**
 * Class Puzzle
 *
 * @package Scandinaver\Puzzle\Domain\Model
 */
class Puzzle extends AggregateRoot
{
    use EventTrait;

    private int $id;

    private PuzzleText $text;

    private PuzzleTranslate $translate;

    private DateTime $createdAt;

    private ?DateTime $updatedAt;

    private $users;

    private Language $language;

    public function __construct(PuzzleText $text, PuzzleTranslate $translate)
    {
        $this->text      = $text;
        $this->translate = $translate;

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
    public function delete()
    {
        // $this->pushEvent(PuzzleDeleted($this));
    }
}
