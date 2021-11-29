<?php


namespace Scandinaver\Learning\Asset\Domain\DTO;

use Scandinaver\Core\Domain\DTO;

/**
 * Class TranslateDTO
 *
 * @package Scandinaver\Learn\Domain\Entity
 */
class TranslateDTO extends DTO
{

    private ?int $id;

    private string $value;

    public function __construct(?int $id, string $value)
    {
        $this->id    = $id;
        $this->value = $value;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function setValue(string $value): void
    {
        $this->value = $value;
    }

    public static function fromArray(array $data): TranslateDTO
    {
        return new self($data['id'] ?? NULL, $data['value']);
    }
}