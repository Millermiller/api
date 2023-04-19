<?php

namespace Scandinaver\Statistic\Domain\DTO;

use Scandinaver\Core\Domain\Contract\UserInterface;
use Scandinaver\Statistic\Domain\Enum\StatisticType;

/**
 *
 */
class StatisticItemDTO
{

    public function __construct(
        private readonly StatisticType $type,
        private readonly UserInterface $user,
        private readonly ?int          $value = NULL,
        private readonly ?array        $data = NULL,
    ) {
    }

    public function getType(): StatisticType
    {
        return $this->type;
    }

    public function getValue(): ?int
    {
        return $this->value;
    }

    public function getUser(): UserInterface
    {
        return $this->user;
    }

    public function getData(): ?array
    {
        return $this->data;
    }
}