<?php


namespace Scandinaver\Core\Infrastructure;


use JetBrains\PhpStorm\Pure;
use JsonMapper;
use JsonMapper_Exception;

/**
 * Class FilterParsingService
 *
 * @package Scandinaver\Core\Infrastructure
 */
class FilterParsingService
{

    private JsonMapper $mapper;


    #[Pure]
    public function __construct()
    {
        $this->mapper = new JsonMapper();
    }

    /**
     * @param  array  $filterInput
     *
     * @return array
     * @throws JsonMapper_Exception
     */
    public function parse(array $filterInput): array
    {
        $filters = [];

        if (array_key_exists('logic', $filterInput) && 'or' === $filterInput['logic']) {
            $filterValue = [];
            $filterConfigurationMain = new FilterConfiguration($filterInput['filters'][0]['field'], 'in');
            foreach ($filterInput['filters'] as $filter) {
                $filterConfiguration = $this->buildOne($filter);
                $filterValue[] = $filterConfiguration->getValue();
            }

            $filterConfigurationMain->setValue($filterValue);

            return [$filterConfigurationMain];
        }

        foreach ($filterInput as $filter) {
            $filterConfiguration = $this->buildOne($this->mapper->map(json_decode($filter), new FilterParameter()));
            $filters[] = $filterConfiguration;
        }

        return $filters;
    }

    #[Pure]
    private function buildOne(FilterParameter $parameter): FilterConfiguration
    {
        $operator = strtolower($parameter->operator);
        $fieldName = $parameter->field;
        $fieldValue = $parameter->value;

        if ('gt' === $operator) {
            $operator = '>=';
        }

        if ('lt' === $operator) {
            $operator = '<=';
        }

        if ('eq' === $operator) {
            $operator = '=';
        }

        if ('like' === $operator) {
            $operator = 'like';
        }

        return new FilterConfiguration($fieldName, $operator, $fieldValue);
    }
}
