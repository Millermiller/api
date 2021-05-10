<?php


namespace Scandinaver\Blog\Domain\DTO;

use Scandinaver\Shared\DTO;

/**
 * Class CategoryDTO
 *
 * @package Scandinaver\Blog\Domain\DTO
 */
class CategoryDTO extends DTO
{

    private ?int $id;

    private string $title;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public static function fromArray(array $data): CategoryDTO
    {
        $categoryDTO = new self();

        $categoryDTO->setId($data['id'] ?? NULL);
        $categoryDTO->setTitle($data['title'] ?? NULL);

        return $categoryDTO;
    }
}