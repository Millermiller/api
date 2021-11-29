<?php


namespace App\Http\Requests;


use InvalidArgumentException;
use JsonMapper;
use JsonMapper_Exception;
use Scandinaver\Core\Infrastructure\FilterParsingService;
use Scandinaver\Core\Infrastructure\RequestParametersComposition;
use Scandinaver\Core\Infrastructure\SortParameter;

/**
 * Trait ApiRequestParsingTrait
 *
 * @package App\Http\Requests
 */
trait ApiRequestParsingTrait
{
    /**
     * @return RequestParametersComposition
     *
     * @throws InvalidArgumentException|JsonMapper_Exception
     */
    public function getRequestParameters(): RequestParametersComposition
    {
        $result = new RequestParametersComposition();
        $queryParams = $this->query->all();

        $pagination = $this->parseRequestForListPagination();
        $result->setOffset($pagination[0]);
        $result->setLimit($pagination[1]);
        $result->setPage($pagination[2]);

        $result->setSort($this->parseRequestForListSort());

        $filterParsingService = new FilterParsingService();
        $filterConfigurations = [];
        if (array_key_exists('filters', $queryParams)) {
            $filterConfigurations = $filterParsingService->parse($queryParams['filters']);
        }

        $result->setFilter($filterConfigurations);

        return $result;
    }

    /**
     * @return array
     * @throws JsonMapper_Exception
     */
    private function parseRequestForListSort(): array
    {
        $input = $this->query->all();
        if (empty($input['sort'])) {
            return [];
        }

        $sort = [];

        $mapper = new JsonMapper();
        foreach ($input['sort'] as $sortItem) {
            $sort[] = $mapper->map(json_decode($sortItem), new SortParameter());
        }

        return $sort;
    }

    private function parseRequestForListPagination(): array
    {
        $defaultRange = 1000;
        $pager_input = $this->query->all();

        $page = $pager_input['page'] ?? 1;
        if (!ctype_digit((string) $page) || $page < 1) {
            throw new \InvalidArgumentException('"Page" property should be numeric and equal or higher than 1.');
        }

        $range = isset($pager_input['pageSize']) ? (int) $pager_input['pageSize'] : $defaultRange;
        if (!ctype_digit((string) $range) || $range < 1) {
            throw new \InvalidArgumentException('"Range" property should be numeric and equal or higher than 1.');
        }

        $offset = ($page - 1) * $range;

        return [$offset, $range, $page];
    }
}