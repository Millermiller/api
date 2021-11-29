<?php


namespace Scandinaver\Common\Domain\Entity;

use DateTime;
use Scandinaver\Core\Domain\Contract\UserInterface;
use Scandinaver\Core\Domain\AggregateRoot;

/**
 * Class AbstractPassing
 *
 * @package Scandinaver\Common\Domain\Entity
 */
abstract class AbstractPassing extends AggregateRoot
{
    protected ?int $id;

    protected UserInterface $user;

    protected bool $completed;

    protected int $percent;

    protected array $data;

    protected Language $language;

    protected AbstractLearnItem $subject;

    protected DateTime $createdAt;

    protected ?DateTime $updatedAt;

    public function getId(): int
    {
        return $this->id;
    }

    public function isCompleted(): bool
    {
        return $this->completed;
    }

    public function setCompleted(bool $completed): void
    {
        $this->completed = $completed;
    }

    public function getSubject(): AbstractLearnItem
    {
        return $this->subject;
    }

    public function getUser(): UserInterface
    {
        return $this->user;
    }

    public function getPercent(): int
    {
        return $this->percent;
    }

    public function setPercent(int $percent): void
    {
        $this->percent = $percent;
    }
}