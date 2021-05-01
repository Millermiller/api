<?php


namespace Scandinaver\Translate\UI\Query;

use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class GetTextQuery
 *
 * @see     \Scandinaver\Translate\Application\Handler\Query\GetTextQueryHandler
 * @package Scandinaver\Translate\UI\Query
 */
class GetTextQuery implements CommandInterface
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