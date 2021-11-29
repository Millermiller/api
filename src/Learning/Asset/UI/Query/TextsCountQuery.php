<?php


namespace Scandinaver\Learning\Asset\UI\Query;

use Scandinaver\Core\Domain\Attribute\Query;
use Scandinaver\Core\Domain\Contract\QueryInterface;
use Scandinaver\Learning\Asset\Application\Handler\Query\TextsCountByLanguageQueryHandler;

/**
 * Class TextsCountQuery
 *
 * @package Scandinaver\Learn\UI\Query
 */
#[Query(TextsCountByLanguageQueryHandler::class)]
class TextsCountQuery implements QueryInterface
{

    public function __construct()
    {
    }
}