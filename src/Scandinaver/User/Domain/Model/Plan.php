<?php


namespace Scandinaver\User\Domain\Model;

use JsonSerializable;

/**
 * Class Plan
 *
 * @package Scandinaver\User\Domain\Model
 */
class Plan implements JsonSerializable
{
    private int $id;

    private string $name;

    private string $period;

    private int $cost;

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
