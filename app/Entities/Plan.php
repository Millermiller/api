<?php

namespace  App\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Plans
 *
 * @ORM\Table(name="plans")
 * @ORM\Entity
 */
class Plan
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="name", type="string", length=50, nullable=true)
     */
    private $name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="period", type="string", length=50, nullable=true)
     */
    private $period;

    /**
     * @var int|null
     *
     * @ORM\Column(name="cost", type="integer", nullable=true)
     */
    private $cost;

    /**
     * @var int|null
     *
     * @ORM\Column(name="cost_per_month", type="integer", nullable=true)
     */
    private $costPerMonth;

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }


}
