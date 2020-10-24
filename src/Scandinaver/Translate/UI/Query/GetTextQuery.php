<?php


namespace Scandinaver\Translate\UI\Query;

use Scandinaver\Shared\Contract\Query;

/**
 * Class GetTextQuery
 *
 * @see     \Scandinaver\Translate\Application\Handler\Query\GetTextHandler
 * @package Scandinaver\Translate\UI\Query
 */
class GetTextQuery implements Query
{
    private int $text;

    public function __construct(int $text)
    {
        $this->text = $text;
    }

    public function getText(): int
    {
        return $this->text;
    }
}