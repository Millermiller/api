<?php


namespace Scandinaver\Translate\Domain\DTO;


use Scandinaver\Shared\DTO;

/**
 * Class ExtraDTO
 *
 * @package Scandinaver\Translate\Domain\DTO
 */
class ExtraDTO extends DTO
{
    private ?int $id;

    private string $object;

    private string $value;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getObject(): string
    {
        return $this->object;
    }

    public function setObject(string $object): void
    {
        $this->object = $object;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function setValue(string $value): void
    {
        $this->value = $value;
    }

    public static function fromArray(array $data): ExtraDTO
    {
        $extraDTO = new self();
        $extraDTO->setId($data['id'] ?? NULL);
        $extraDTO->setObject($data['object']);
        $extraDTO->setValue($data['value']);

        return $extraDTO;
    }
}