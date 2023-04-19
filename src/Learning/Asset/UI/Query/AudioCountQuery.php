<?php


namespace Scandinaver\Learning\Asset\UI\Query;

use Scandinaver\Core\Domain\Attribute\Handler;
use Scandinaver\Core\Domain\Contract\QueryInterface;
use Scandinaver\Learning\Asset\Application\Handler\Query\AudioCountQueryHandler;

/**
 * Class AudioCountQuery
 *
 * @package Scandinaver\Learn\UI\Query
 */
#[Handler(AudioCountQueryHandler::class)]
class AudioCountQuery implements QueryInterface
{

    public function __construct()
    {
    }
}