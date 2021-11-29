<?php


namespace Scandinaver\Core\Infrastructure;


/**
 * Class FilterConfiguration
 *
 * @package Scandinaver\Core\Infrastructure
 */
class FilterConfiguration
{

    public function __construct(
        protected string $field,
        protected string $operator,
        protected string|array|null $value = NULL
    ) {
    }

    public function getValue(): array|null|string
    {
        return $this->value;
    }

    public function getField(): string
    {
        return $this->field;
    }

    public function getOperator(): string
    {
        return $this->operator;
    }

    public function setValue(array|null|string $value): void
    {
        $this->value = $value;
    }

    public function changeFieldName(string $field): void
    {
        $this->field = $field;
    }
}