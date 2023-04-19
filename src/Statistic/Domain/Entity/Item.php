<?php


namespace Scandinaver\Statistic\Domain\Entity;

use DateTime;
use Scandinaver\Common\Domain\Entity\Language;
use Scandinaver\Core\Domain\Contract\UserInterface;
use Scandinaver\Statistic\Domain\Enum\StatisticType;

/**
 * Class Item
 *
 * @package Scandinaver\Statistic\Domain\Entity
 */
class Item
{
    private ?int $id = NULL;

    private Language $language;

    private DateTime $createdAt;

    private ?DateTime $updatedAt;

    public function __construct(
        private readonly StatisticType $type,
        private readonly UserInterface $user,
        private readonly ?int          $value,
        private readonly ?array        $data
    ) {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): StatisticType
    {
        return $this->type;
    }

    public function getUser(): UserInterface
    {
        return $this->user;
    }

    public function getValue(): ?int
    {
        return $this->value;
    }

    public function getData(): ?array
    {
        return $this->data;
    }

    public function getLanguage(): Language
    {
        return $this->language;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }
}