<?php


namespace Scandinaver\Learning\Asset\UI\Query;

use Scandinaver\Core\Domain\Attribute\Query;
use Scandinaver\Core\Domain\Contract\QueryInterface;
use Scandinaver\Learning\Asset\Application\Handler\Query\TermsCountQueryHandler;

/**
 * Class TermsCountQuery
 *
 * @package Scandinaver\Learn\UI\Query
 */
#[Query(TermsCountQueryHandler::class)]
class TermsCountQuery implements QueryInterface
{

    public function __construct()
    {
    }
}