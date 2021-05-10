<?php


namespace Scandinaver\Common\Domain\Model;

use DateTime;
use Scandinaver\Shared\AggregateRoot;

/**
 * Class Message
 *
 * @package Scandinaver\Common\Domain\Model
 */
class Feedback extends AggregateRoot
{
    private int $id;

    private string $name;

    private string $message;

    private bool $readed;

    private DateTime $createdAt;

    private ?DateTime $updatedAt;

    /**
     * Message constructor.
     *
     * @param  string  $name
     * @param  string  $message
     */
    public function __construct(string $name, string $message)
    {
        $this->name      = $name;
        $this->message   = $message;
        $this->createdAt = new DateTime("now");
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }

    public function onDelete()
    {
        // TODO: Implement delete() method.
    }

    public function isRead(): bool
    {
        return $this->readed;
    }

    /**
     * @param  bool  $read
     */
    public function setRead(bool $read): void
    {
        $this->readed = $read;
    }
}
