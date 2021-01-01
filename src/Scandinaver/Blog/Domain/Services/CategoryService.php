<?php


namespace Scandinaver\Blog\Domain\Services;

use Scandinaver\Blog\Domain\Contract\Repository\CategoryRepositoryInterface;
use Scandinaver\Blog\Domain\Exception\CategoryDublicateException;
use Scandinaver\Blog\Domain\Exception\CategoryNotFoundException;
use Scandinaver\Blog\Domain\Model\Category;
use Scandinaver\Blog\Domain\Model\CategoryDTO;

/**
 * Class CategoryService
 *
 * @package Scandinaver\Blog\Domain\Services
 */
class CategoryService
{
    private CategoryRepositoryInterface $categoryRepo;

    public function __construct(CategoryRepositoryInterface $categoryRepo)
    {
        $this->categoryRepo = $categoryRepo;
    }

    public function getAll(): array
    {
        $result = [];
        /** @var Category[] $categories */
        $categories = $this->categoryRepo->findAll();
        foreach ($categories as $category) {
            $result[] = $category->toDTO();
        }

        return $result;
    }

    public function one(int $categoryId): CategoryDTO
    {
        $category = $this->getCategory($categoryId);

        return $category->toDTO();
    }

    public function create(array $data): CategoryDTO
    {
        $category = new Category($data['name']);

        $isDublicate = $this->categoryRepo->findOneBy(
            [
                'name' => $data['name'],
            ]
        );

        if ($isDublicate !== null) {
            throw new CategoryDublicateException();
        }

        $this->categoryRepo->save($category);

        return $category->toDTO();
    }

    public function update(int $categoryId, array $data): CategoryDTO
    {
        $category = $this->getCategory($categoryId);

        $this->categoryRepo->update($category, $data);

        return $category->toDTO();
    }

    public function delete(int $category)
    {
        $category = $this->getCategory($category);
        $category->delete();
        $this->categoryRepo->delete($category);
    }

    private function getCategory(int $id): Category
    {
        /** @var  Category $category */
        $category = $this->categoryRepo->find($id);

        if ($category === null) {
            throw new CategoryNotFoundException();
        }

        return $category;
    }

}