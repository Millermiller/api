<?php


namespace Scandinaver\Blog\Domain\Service;

use Scandinaver\Blog\Domain\Contract\Repository\CategoryRepositoryInterface;
use Scandinaver\Blog\Domain\Exception\CategoryDuplicateException;
use Scandinaver\Blog\Domain\Exception\CategoryNotFoundException;
use Scandinaver\Blog\Domain\Model\Category;
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
        /** @var Category[] $categories */
        $categories = $this->categoryRepo->findAll();

        return $categories;
    }

    /**
     * @param  int  $id
     *
     * @return Category
     * @throws CategoryNotFoundException
     */
    public function one(int $id): Category
    {
        return $this->getCategory($id);
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
     * @return Category
     * @throws CategoryDuplicateException
     */
    public function create(array $data): Category
    {
        $category = new Category($data['title']);

        $isDuplicate = $this->categoryRepo->findOneBy([
            'title' => $data['title'],
        ]);

        if ($isDuplicate !== NULL) {
            throw new CategoryDuplicateException();
        }

        $this->categoryRepo->save($category);

        return $category;
    }

    /**
     * @param  int    $categoryId
     * @param  array  $data
     *
     * @return Category
     * @throws CategoryNotFoundException
     */
    public function update(int $categoryId, array $data): Category
    {
        $category = $this->getCategory($categoryId);

        $this->categoryRepo->update($category, $data);

        return $category;
    }

    /**
     * @param  int  $category
     *
     * @throws CategoryNotFoundException
     */
    public function delete(int $category): void
    {
        $category = $this->getCategory($category);
        $category->delete();
        $this->categoryRepo->delete($category);
    }
}