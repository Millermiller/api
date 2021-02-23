<?php


namespace Scandinaver\Blog\Domain\Model;


use Scandinaver\Shared\DTO;

/**
 * Class CategoryDTO
 *
 * @package Scandinaver\Blog\Domain\Model
 */
class CategoryDTO extends DTO
{
    private Category $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function jsonSerialize(): array
    {
        return [
            'id'   => $this->category->getId(),
            'name' => $this->category->getName(),
        ];
    }
}