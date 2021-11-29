<?php


namespace Scandinaver\Core\Infrastructure;


use Doctrine\Common\Collections\Criteria;
use JetBrains\PhpStorm\ArrayShape;

/**
 * Class RequestParametersComposition
 *
 * @package Scandinaver\Core\Infrastructure
 */
class RequestParametersComposition
{
    protected array $sort = [];
    protected array $filter = [];
    protected ?int $limit = 1000;
    protected ?int $offset = 0;
    protected ?int $page = 1;

    public function getSort(): array
    {
        return $this->sort;
    }

    public function setSort(array $sort): void
    {
        $this->sort = $sort;
    }

    #[ArrayShape([FilterConfiguration::class])]
    public function getFilter(): array
    {
        return $this->filter;
    }

    public function setFilter(array $filter): void
    {
        $this->filter = $filter;
    }

    public function getLimit(): ?int
    {
        return $this->limit;
    }

    public function setLimit(?int $limit): void
    {
        $this->limit = $limit;
    }

    public function getOffset(): ?int
    {
        return $this->offset;
    }

    public function setOffset(?int $offset): void
    {
        $this->offset = $offset;
    }

    public function getPage(): int
    {
        return $this->page;
    }

    public function setPage(int $page): int
    {
        return $this->page = $page;
    }

    public function buildCriteria(array $alias = NULL): Criteria
    {
        $criteria = Criteria::create();
        foreach ($this->getFilter() as $filterConfiguration) {
            $fieldName = $filterConfiguration->getField();
            $operator = $filterConfiguration->getOperator();

            [$entityName, $entityField] = explode('.', $fieldName);
            $isExist = in_array($entityName, $alias, TRUE);

            if ($isExist) {
                $expression = match ($operator) {
                    'in' => Criteria::expr()->in($fieldName, $filterConfiguration->getValue()),
                    'contains', 'like' => Criteria::expr()->contains($fieldName, $filterConfiguration->getValue()),
                    'gte' => Criteria::expr()->gte($fieldName, $filterConfiguration->getValue()),
                    'lte' => Criteria::expr()->lte($fieldName, $filterConfiguration->getValue()),
                    default => Criteria::expr()->eq($fieldName, $filterConfiguration->getValue()),
                };
                $criteria->andWhere($expression);
            }
        }

        $criteria->setMaxResults($this->getLimit());
        $criteria->setFirstResult($this->getOffset());

        foreach ($this->getSort() as $item) {
            [$entityName, $entityField] = explode('.', $item->field);
            $isExist = in_array($entityName, $alias, TRUE);
            if ($isExist) {
                $criteria->orderBy([$item->field => $item->order]);
            }
        }

        return $criteria;
    }
}