<?php


namespace Scandinaver\Learning\Translate\UI\Query;

use Scandinaver\Core\Domain\Attribute\Handler;
use Scandinaver\Core\Domain\Contract\QueryInterface;
use Scandinaver\Learning\Translate\Application\Handler\Query\GetTextQueryHandler;

/**
 * Class GetTextQuery
 *
 * @package Scandinaver\Learning\Translate\UI\Query
 */
#[Handler(GetTextQueryHandler::class)]
class GetTextQuery implements QueryInterface
{

    public function __construct(private int $text)
    {
    }

    public function getText(): int
    {
        return $this->text;
    }
}