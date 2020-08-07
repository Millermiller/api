<?php


namespace Scandinaver\Common\Domain\Model;

use DateTime;
use Exception;
use JsonSerializable;

/**
 * Class Message
 *
 * @package Scandinaver\Common\Domain\Model
 */
class Message implements JsonSerializable
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

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'message' => $this->message,
        ];
    }
}
