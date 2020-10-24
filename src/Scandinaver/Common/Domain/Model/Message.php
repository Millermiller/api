<?php


namespace Scandinaver\Common\Domain\Model;

use DateTime;
use Exception;
use JsonSerializable;
use Scandinaver\Shared\AggregateRoot;
use Scandinaver\Shared\DTO;

/**
 * Class Message
 *
 * @package Scandinaver\Common\Domain\Model
 */
class Message extends AggregateRoot
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
        $this->name = $name;
        $this->message = $message;
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

    public function toDTO(): MessageDTO
    {
        return new MessageDTO($this);
    }

    public function delete()
    {
        // TODO: Implement delete() method.
    }
}
