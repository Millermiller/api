<?php


namespace Scandinaver\Settings\UI\Query;

use Scandinaver\Core\Domain\Attribute\Query;
use Scandinaver\Core\Domain\Contract\QueryInterface;
use Scandinaver\Core\Domain\FilteringQuery;
use Scandinaver\Core\Infrastructure\RequestParametersComposition;
use Scandinaver\Settings\Application\Handler\Query\SettingsQueryHandler;

/**
 * Class SettingsQuery
 *
 * @package Scandinaver\Settings\UI\Query
 */
#[Query(SettingsQueryHandler::class)]
class SettingsQuery extends FilteringQuery implements QueryInterface
{

}