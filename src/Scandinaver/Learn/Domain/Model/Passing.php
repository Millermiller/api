<?php


namespace Scandinaver\Learn\Domain\Model;

use DateTime;
use Scandinaver\Common\Domain\Contract\UserInterface;
use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\Shared\AggregateRoot;

/**
 * Class Passing
 *
 * @package Scandinaver\Learn\Domain\Model
 */
class Passing extends AggregateRoot
{
    private ?int $id;

    private Language $language;

    private Asset $asset;

    private UserInterface $user;

    private bool $completed;

    private int $percent;

    private array $data;

    private DateTime $createdAt;

    private ?DateTime $updatedAt;

    public function __construct(Asset $asset, UserInterface $user, bool $completed, array $data)
    {
        $this->asset     = $asset;
        $this->language  = $asset->getLanguage();
        $this->user      = $user;
        $this->completed = $completed;
        $this->percent   = $data['percent'];
        $this->data      = $data['payload'];
    }

    public function isCompleted(): bool
    {
        return $this->completed;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function delete()
    {
        // TODO: Implement delete() method.
    }

    public function getAsset(): Asset
    {
        return $this->asset;
    }

    public function getUser(): UserInterface
    {
        return $this->user;
    }

    public function getPercent(): int
    {
        return $this->percent;
    }

    public function getTime(): int
    {
        return $this->data['time'];
    }

    public function getErrors(): array
    {
        return $this->data['errors'];
    }

    public function setPercent(int $percent): void
    {
        $this->percent = $percent;
    }

    public function setCompleted(bool $completed): void
    {
        $this->completed = $completed;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }
}
