<?php

namespace Scandinaver\Billing\Domain\DTO;

use Scandinaver\Core\Domain\Contract\UserInterface;
use Scandinaver\Core\Domain\DTO;


/**
 * Class OrderDTO
 *
 * @package Scandinaver\Billing\Domain\DTO
 */
class OrderDTO extends DTO
{

    private float $sum;

    private UserInterface $user;

    public function getSum(): float
    {
        return $this->sum;
    }

    public function setSum(float $sum): self
    {
        $this->sum = $sum;

        return $this;
    }

    public function getUser(): UserInterface
    {
        return $this->user;
    }

    public function setUser(UserInterface $user): self
    {
        $this->user = $user;

        return $this;
    }

    public static function fromArray(array $data): self
    {
        return (new self())
                    ->setSum($data['sum'])
                    ->setUser($data['user']);
    }
}