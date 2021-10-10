<?php


namespace Scandinaver\Learn\Domain\DTO;

use Scandinaver\Shared\DTO;

/**
 * Class TermDTO
 *
 * @package Scandinaver\Learn\Domain\Entity
 */
class TermDTO extends DTO
{
    private ?int $id;

    private string $value;

    private bool $public;

    public function __construct(?int $id, string $value)
    {
        $this->id    = $id;
        $this->value = $value;
        $this->public = FALSE; //TODO: implement
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


    public static function fromArray(array $data): TermDTO
    {
        return new self($data['id'] ?? NULL, $data['value']);
    }

    public function isPublic(): bool
    {
        return $this->public;
    }

    public function setPublic(bool $public): void
    {
        $this->public = $public;
    }
}