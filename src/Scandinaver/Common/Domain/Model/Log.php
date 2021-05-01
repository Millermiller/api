<?php


namespace Scandinaver\Common\Domain\Model;

use DateTime;
use Scandinaver\Common\Domain\Contract\UserInterface;

/**
 * Class Log
 *
 * @package Scandinaver\Common\Domain\Model
 */
class Log
{
    private int $id;

    private string $message;

    private array $context;

    private int $level;

    private string $levelName;

    private ?array $extra;

    private DateTime $createdAt;

    private ?UserInterface $owner;

    public function __construct(
        ?UserInterface $owner,
        string $levelName,
        string $message,
        array $context = [],
        array $extra = []
    ) {
        $this->owner     = $owner;
        $this->levelName = $levelName;
        $this->message   = $message;
        $this->context   = $context;
        $this->extra     = $extra;
    }

    public function interpolate(): string
    {
        $replace = [];
        foreach ($this->context as $key => $val) {
            $replace['{'.$key.'}'] = $val;
        }

        return strtr($this->message, $replace);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function getOwner(): UserInterface
    {
        return $this->owner;
    }

    public function getLevelName(): string
    {
        return $this->levelName;
    }

    public function getExtra(): ?array
    {
        return $this->extra;
    }
}