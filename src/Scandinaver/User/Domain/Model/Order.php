<?php


namespace Scandinaver\User\Domain\Model;

use DateTime;
use Scandinaver\Common\Domain\Contract\UserInterface;

/**
 * Class Order
 *
 * @package Scandinaver\User\Domain\Model
 */
class Order
{
    private int $id;

    private int $sum;

    private ?string $status;

    private ?string $notificationType;

    private ?string $datetime;

    private ?string $codepro;

    private ?string $sender;

    private ?string $sha1Hash;

    private ?string $label;

    private DateTime $createdAt;

    private ?DateTime $updatedAt;

    private Plan $plan;

    private UserInterface $user;

    public function setUpdatedAt(?DateTime $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getSum(): int
    {
        return $this->sum;
    }

    public function setSum(int $sum): void
    {
        $this->sum = $sum;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): void
    {
        $this->status = $status;
    }

    public function getNotificationType(): ?string
    {
        return $this->notificationType;
    }

    public function setNotificationType(?string $notificationType): void
    {
        $this->notificationType = $notificationType;
    }

    public function getDatetime(): ?string
    {
        return $this->datetime;
    }

    public function setDatetime(?string $datetime): void
    {
        $this->datetime = $datetime;
    }

    public function getCodepro(): ?string
    {
        return $this->codepro;
    }

    public function setCodepro(?string $codepro): void
    {
        $this->codepro = $codepro;
    }

    public function getSender(): ?string
    {
        return $this->sender;
    }

    public function setSender(?string $sender): void
    {
        $this->sender = $sender;
    }

    public function getSha1Hash(): ?string
    {
        return $this->sha1Hash;
    }

    public function setSha1Hash(?string $sha1Hash): void
    {
        $this->sha1Hash = $sha1Hash;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(?string $label): void
    {
        $this->label = $label;
    }

    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }

    public function getPlan(): Plan
    {
        return $this->plan;
    }

    public function setPlan(Plan $plan): void
    {
        $this->plan = $plan;
    }

    public function getUser(): UserInterface
    {
        return $this->user;
    }

    public function setUser(UserInterface $user): void
    {
        $this->user = $user;
    }
}
