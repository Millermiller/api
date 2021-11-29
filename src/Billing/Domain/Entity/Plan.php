<?php


namespace Scandinaver\Billing\Domain\Entity;


use DateInterval;
use DatePeriod;
use Ramsey\Uuid\UuidInterface;
use Scandinaver\Billing\Domain\Contract\PeriodServiceInterface;

/**
 * Class Plan
 *
 * @package Scandinaver\Billing\Domain\Entity
 */
class Plan implements PeriodServiceInterface
{

    private UuidInterface $id;

    private string $name;

    private DateInterval $period;

    private float $cost;

    private float $costPerMonth;

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getDuration(): DateInterval
    {
        return $this->period;
    }

    public function setPeriod(DateInterval $period): void
    {
        $this->period = $period;
    }

    public function setCost(float $cost): void
    {
        $this->cost = $cost;
    }

    public function setCostPerMonth(float $costPerMonth): void
    {
        $this->costPerMonth = $costPerMonth;
    }
}
