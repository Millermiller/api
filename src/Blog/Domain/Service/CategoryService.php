<?php


namespace Scandinaver\Blog\Domain\Service;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Scandinaver\Blog\Domain\Contract\Repository\CategoryRepositoryInterface;
use Scandinaver\Blog\Domain\DTO\CategoryDTO;
use Scandinaver\Blog\Domain\Entity\Category;
use Scandinaver\Blog\Domain\Exception\CategoryDuplicateException;
use Scandinaver\Blog\Domain\Exception\CategoryNotFoundException;
use Scandinaver\Core\Domain\Contract\BaseServiceInterface;
use Scandinaver\Core\Infrastructure\RequestParametersComposition;

/**
 * Class CategoryService
 *
 * @package Scandinaver\Blog\Domain\Services
 */
class CategoryService implements BaseServiceInterface
{

    public function __construct(
        private CategoryRepositoryInterface $categoryRepository,
        private CategoryFactory $categoryFactory
    ) {
    }

    /**
     * @param  RequestParametersComposition  $params
     *
     * @return LengthAwarePaginator
     */
    public function all(RequestParametersComposition $params): LengthAwarePaginator
    {
        return $this->categoryRepository->getData($params);
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
        $category = $this->categoryRepository->find($id);

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

        $isDuplicate = $this->categoryRepository->findOneBy([
            'title' => $category->getTitle(),
        ]);

        if ($isDuplicate !== NULL) {
            throw new CategoryDuplicateException();
        }

        $this->categoryRepository->save($category);

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

        $this->categoryRepository->save($category);

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
        $this->categoryRepository->delete($category);
    }
}