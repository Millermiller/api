<?php


namespace Scandinaver\User\Domain\Model;

use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;

/**
 * Plans
 * @ORM\Table(name="plan")
 *
 * @ORM\Entity
 */
class Plan implements JsonSerializable
{
    /**
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private int $id;

    /**
     * @ORM\Column(name="name", type="string", length=50, nullable=false)
     */
    private string $name;

    /**
     * @ORM\Column(name="period", type="string", length=50, nullable=false)
     */
    private string $period;

    /**
     * @ORM\Column(name="cost", type="integer", nullable=true)
     */
    private int $cost;

    /**
     * @ORM\Column(name="cost_per_month", type="integer", nullable=true)
     */
    private int $costPerMonth;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'period' => $this->period,
            'cost' => $this->cost,
        ];
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }
}
