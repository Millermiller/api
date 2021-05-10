<?php


namespace Scandinaver\Blog\Domain\Service;


use Scandinaver\Blog\Domain\DTO\CategoryDTO;
use Scandinaver\Blog\Domain\Model\Category;

/**
 * Class CategoryFactory
 *
 * @package Scandinaver\Blog\Domain\Service
 */
class CategoryFactory
{

    /**
     * @param  CategoryDTO  $categoryDTO
     *
     * @return Category
     */
    public function fromDTO(CategoryDTO $categoryDTO): Category
    {
        $category = new Category($categoryDTO->getTitle());

        $id = $categoryDTO->getId();
        if ($id !== NULL) {
            $category->setId($id);
        }

        return $category;
    }

    public function toDTO(Category $category): CategoryDTO
    {
        return CategoryDTO::fromArray([
            'id'    => $category->getId(),
            'title' => $category->getTitle(),
        ]);
    }
}