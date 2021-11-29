<?php


namespace Scandinaver\Learning\Puzzle\UI\Query;

use Scandinaver\Core\Domain\Attribute\Query;
use Scandinaver\Core\Domain\Contract\QueryInterface;
use Scandinaver\Learning\Puzzle\Application\Handler\Query\PuzzlesQueryHandler;

/**
 * Class PuzzlesQuery
 *
 * @package Scandinaver\Puzzle\UI\Query
 */
#[Query(PuzzlesQueryHandler::class)]
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