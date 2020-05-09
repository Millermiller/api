<?php


namespace Scandinaver\User\Domain;

use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;

/**
 * Plans
 * @ORM\Table(name="plans")
 *
 * @ORM\Entity
 */
class Plan implements JsonSerializable
{
    /**
     * @var int
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string|null
     * @ORM\Column(name="name", type="string", length=50, nullable=true)
     */
    private $name;

    /**
     * @var string|null
     * @ORM\Column(name="period", type="string", length=50, nullable=true)
     */
    private $period;

    /**
     * @var int|null
     * @ORM\Column(name="cost", type="integer", nullable=true)
     */
    private $cost;

    /**
     * @var int|null
     * @ORM\Column(name="cost_per_month", type="integer", nullable=true)
     */
    private $costPerMonth;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            'id'     => $this->id,
            'name'   => $this->name,
            'period' => $this->period,
            'cost'   => $this->cost,
        ];
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }
}
