<?php


namespace Scandinaver\User\Domain;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * Orders
 * @ORM\Table(name="orders", indexes={@ORM\Index(name="user_id", columns={"user_id"}), @ORM\Index(name="plan_id", columns={"plan_id"})})
 *
 * @ORM\Entity
 */
class Order
{
    /**
     * @var int
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int
     * @ORM\Column(name="sum", type="integer", nullable=false)
     */
    private $sum = '0';

    /**
     * @var string|null
     * @ORM\Column(name="status", type="string", length=50, nullable=true)
     */
    private $status;

    /**
     * @var string|null
     * @ORM\Column(name="notification_type", type="string", length=255, nullable=true)
     */
    private $notificationType;

    /**
     * @var string|null
     * @ORM\Column(name="datetime", type="string", length=255, nullable=true)
     */
    private $datetime;

    /**
     * @var string|null
     * @ORM\Column(name="codepro", type="string", length=255, nullable=true)
     */
    private $codepro;

    /**
     * @var string|null
     * @ORM\Column(name="sender", type="string", length=255, nullable=true)
     */
    private $sender;

    /**
     * @var string|null
     * @ORM\Column(name="sha1_hash", type="string", length=255, nullable=true)
     */
    private $sha1Hash;

    /**
     * @var string|null
     * @ORM\Column(name="label", type="string", length=255, nullable=true)
     */
    private $label;

    /**
     * @var DateTime|null
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @var DateTime|null
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @var DateTime|null
     * @ORM\Column(name="deleted_at", type="datetime", nullable=true)
     */
    private $deletedAt;

    /**
     * @var Plan
     * @ORM\ManyToOne(targetEntity="Plan")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="plan_id", referencedColumnName="id")
     * })
     */
    private $plan;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;

    /**
     * @param DateTime|null $updatedAt
     */
    public function setUpdatedAt(?DateTime $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getSum(): int
    {
        return $this->sum;
    }

    /**
     * @param int $sum
     */
    public function setSum(int $sum): void
    {
        $this->sum = $sum;
    }

    /**
     * @return string|null
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @param string|null $status
     */
    public function setStatus(?string $status): void
    {
        $this->status = $status;
    }

    /**
     * @return string|null
     */
    public function getNotificationType(): ?string
    {
        return $this->notificationType;
    }

    /**
     * @param string|null $notificationType
     */
    public function setNotificationType(?string $notificationType): void
    {
        $this->notificationType = $notificationType;
    }

    /**
     * @return string|null
     */
    public function getDatetime(): ?string
    {
        return $this->datetime;
    }

    /**
     * @param string|null $datetime
     */
    public function setDatetime(?string $datetime): void
    {
        $this->datetime = $datetime;
    }

    /**
     * @return string|null
     */
    public function getCodepro(): ?string
    {
        return $this->codepro;
    }

    /**
     * @param string|null $codepro
     */
    public function setCodepro(?string $codepro): void
    {
        $this->codepro = $codepro;
    }

    /**
     * @return string|null
     */
    public function getSender(): ?string
    {
        return $this->sender;
    }

    /**
     * @param string|null $sender
     */
    public function setSender(?string $sender): void
    {
        $this->sender = $sender;
    }

    /**
     * @return string|null
     */
    public function getSha1Hash(): ?string
    {
        return $this->sha1Hash;
    }

    /**
     * @param string|null $sha1Hash
     */
    public function setSha1Hash(?string $sha1Hash): void
    {
        $this->sha1Hash = $sha1Hash;
    }

    /**
     * @return string|null
     */
    public function getLabel(): ?string
    {
        return $this->label;
    }

    /**
     * @param string|null $label
     */
    public function setLabel(?string $label): void
    {
        $this->label = $label;
    }

    /**
     * @return DateTime|null
     */
    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }

    /**
     * @return Plan
     */
    public function getPlan(): Plan
    {
        return $this->plan;
    }

    /**
     * @param Plan $plan
     */
    public function setPlan(Plan $plan): void
    {
        $this->plan = $plan;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user): void
    {
        $this->user = $user;
    }

}
