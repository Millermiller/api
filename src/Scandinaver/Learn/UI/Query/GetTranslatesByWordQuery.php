<?php


namespace Scandinaver\Learn\UI\Query;

use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class GetTranslatesByWordQuery
 *
 * @package Scandinaver\Learn\UI\Query
 *
 * @see     \Scandinaver\Learn\Application\Handler\Query\GetTranslatesByWordQueryHandler
 */
class GetTranslatesByWordQuery implements CommandInterface
{
    private int $word;

    public function __construct(int $word)
    {
        $this->word = $word;
    }

    public function getWord(): int
    {
        return $this->word;
    }
}