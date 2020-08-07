<?php


namespace Scandinaver\User\Domain\Model;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * Orders
 * @ORM\Table(name="order", indexes={@ORM\Index(name="user_id", columns={"user_id"}), @ORM\Index(name="plan_id", columns={"plan_id"})})
 *
 * @ORM\Entity
 */
class Order
{
    /**
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private int $id;

    /**
     * @var int
     * @ORM\Column(name="sum", type="integer", nullable=false)
     */
    private int $sum;

    /**
     * @ORM\Column(name="status", type="string", length=50, nullable=true)
     */
    private ?string $status;

    /**
     * @ORM\Column(name="notification_type", type="string", length=255,
     *   nullable=true)
     */
    private ?string $notificationType;

    /**
     * @ORM\Column(name="datetime", type="string", length=255, nullable=true)
     */
    private ?string $datetime;

    /**
     * @ORM\Column(name="codepro", type="string", length=255, nullable=true)
     */
    private ?string $codepro;

    /**
     * @ORM\Column(name="sender", type="string", length=255, nullable=true)
     */
    private ?string $sender;

    /**
     * @ORM\Column(name="sha1_hash", type="string", length=255, nullable=true)
     */
    private ?string $sha1Hash;

    /**
     * @ORM\Column(name="label", type="string", length=255, nullable=true)
     */
    private ?string $label;

    /**
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private DateTime $createdAt;

    /**
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private ?DateTime $updatedAt;

    /**
     * @ORM\ManyToOne(targetEntity="Plan")
     * @ORM\JoinColumn(name="plan_id", referencedColumnName="id")
     */
    private Plan $plan;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private User $user;

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

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
    }
}
