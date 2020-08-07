<?php


namespace Scandinaver\Common\Domain\Model;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Exception;
use JsonSerializable;

/**
 * Messages
 * @ORM\Table(name="message")
 *
 * @ORM\Entity
 */
class Message implements JsonSerializable
{
    /**
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private int $id;

    /**
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private string $name;

    /**
     * @ORM\Column(name="message", type="string", length=255, nullable=true)
     */
    private string $message;

    /**
     * @ORM\Column(name="readed", type="integer", nullable=true)
     */
    private bool $readed;

    /**
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private DateTime $createdAt;

    /**
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private ?DateTime $updatedAt;

    /**
     * @ORM\Column(name="deleted_at", type="datetime", nullable=true)
     */
    private ?DateTime $deletedAt;

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
