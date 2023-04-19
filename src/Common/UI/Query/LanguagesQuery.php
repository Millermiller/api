<?php


namespace Scandinaver\Common\UI\Query;

use Scandinaver\Common\Application\Handler\Query\LanguagesQueryHandler;
use Scandinaver\Core\Domain\Attribute\Handler;
use Scandinaver\Core\Domain\Contract\UserInterface;
use Scandinaver\Core\Domain\Contract\QueryInterface;
use Scandinaver\Core\Domain\FilteringQuery;

/**
 * Class LanguagesQuery
 *
 * @package Scandinaver\Common\UI\Query
 */
#[Handler(LanguagesQueryHandler::class)]
class LanguagesQuery extends FilteringQuery implements QueryInterface
{

}