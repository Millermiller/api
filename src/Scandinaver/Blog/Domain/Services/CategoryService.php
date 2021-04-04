<?php


namespace Scandinaver\Blog\Domain\Services;

use Scandinaver\Blog\Domain\Contract\Repository\CategoryRepositoryInterface;
use Scandinaver\Blog\Domain\Exception\CategoryDuplicateException;
use Scandinaver\Blog\Domain\Exception\CategoryNotFoundException;
use Scandinaver\Blog\Domain\Model\Category;
use Scandinaver\Blog\Domain\Model\CategoryDTO;
use Scandinaver\Shared\Contract\BaseServiceInterface;

/**
 * Class CategoryService
 *
 * @package Scandinaver\Blog\Domain\Services
 */
class CategoryService implements BaseServiceInterface
{
    private CategoryRepositoryInterface $categoryRepo;

    public function __construct(CategoryRepositoryInterface $categoryRepo)
    {
        $this->categoryRepo = $categoryRepo;
    }

    public function all(): array
    {
        $result = [];
        /** @var Category[] $categories */
        $categories = $this->categoryRepo->findAll();
        foreach ($categories as $category) {
            $result[] = $category->toDTO();
        }

        return $result;
    }

    /**
     * @param  int  $id
     *
     * @return CategoryDTO
     * @throws CategoryNotFoundException
     */
    public function one(int $id): CategoryDTO
    {
        $category = $this->getCategory($id);

        return $category->toDTO();
    }

    /**
     * @param  int  $id
     *
     * @return Category
     * @throws CategoryNotFoundException
     */
    private function getCategory(int $id): Category
    {
        /** @var  Category $category */
        $category = $this->categoryRepo->find($id);

        if ($category === NULL) {
            throw new CategoryNotFoundException();
        }

        return $category;
    }

    /**
     * @param  array  $data
     *
     * @return CategoryDTO
     * @throws CategoryDuplicateException
     */
    public function create(array $data): CategoryDTO
    {
        $category = new Category($data['name']);

        $isDuplicate = $this->categoryRepo->findOneBy([
            'name' => $data['name'],
        ]);

        if ($isDuplicate !== NULL) {
            throw new CategoryDuplicateException();
        }

        $this->categoryRepo->save($category);

        return $category->toDTO();
    }

    /**
     * @param  int    $categoryId
     * @param  array  $data
     *
     * @return CategoryDTO
     * @throws CategoryNotFoundException
     */
    public function update(int $categoryId, array $data): CategoryDTO
    {
        $category = $this->getCategory($categoryId);

        $this->categoryRepo->update($category, $data);

        return $category->toDTO();
    }

    /**
     * @param  int  $category
     *
     * @throws CategoryNotFoundException
     */
    public function delete(int $category)
    {
        $category = $this->getCategory($category);
        $category->delete();
        $this->categoryRepo->delete($category);
    }

}