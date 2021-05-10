<?php


namespace Scandinaver\Puzzle\UI\Query;

use Scandinaver\Shared\Contract\QueryInterface;

/**
 * Class PuzzlesQuery
 *
 * @package Scandinaver\Puzzle\UI\Query
 *
 * @see     \Scandinaver\Puzzle\Application\Handler\Query\PuzzlesQueryHandler
 */
class PuzzlesQuery implements QueryInterface
{
    private string $language;

    public function __construct(string $language)
    {
        $this->language = $language;
    }

    public function getLanguage(): string
    {
        return $this->language;
    }
}