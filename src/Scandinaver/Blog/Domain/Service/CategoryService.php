<?php


namespace Scandinaver\Blog\Domain\Service;

use Scandinaver\Blog\Domain\Contract\Repository\CategoryRepositoryInterface;
use Scandinaver\Blog\Domain\DTO\CategoryDTO;
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

    private CategoryFactory $categoryFactory;

    public function __construct(
        CategoryRepositoryInterface $categoryRepo,
        CategoryFactory $categoryFactory
    ) {
        $this->categoryRepo    = $categoryRepo;
        $this->categoryFactory = $categoryFactory;
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
     * @param  CategoryDTO  $categoryDTO
     *
     * @return Category
     * @throws CategoryDuplicateException
     */
    public function create(CategoryDTO $categoryDTO): Category
    {
        $category = $this->categoryFactory->fromDTO($categoryDTO);

        $isDuplicate = $this->categoryRepo->findOneBy([
            'title' => $category->getTitle(),
        ]);

        if ($isDuplicate !== NULL) {
            throw new CategoryDuplicateException();
        }

        $this->categoryRepo->save($category);

        return $category;
    }

    /**
     * @param  int          $id
     * @param  CategoryDTO  $categoryDTO
     *
     * @return Category
     * @throws CategoryNotFoundException
     */
    public function update(int $id, CategoryDTO $categoryDTO): Category
    {
        $category = $this->getCategory($id);

        $category->setTitle($categoryDTO->getTitle());

        $this->categoryRepo->save($category);

        return $category;
    }

    /**
     * @param  int  $id
     *
     * @throws CategoryNotFoundException
     */
    public function delete(int $id): void
    {
        $category = $this->getCategory($id);
        $this->categoryRepo->delete($category);
    }
}