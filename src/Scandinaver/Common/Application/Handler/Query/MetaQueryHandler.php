<?php


namespace Scandinaver\Common\Application\Handler\Query;

use Scandinaver\Common\UI\Query\MetaQuery;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class MetaQueryHandler
 *
 * @package Scandinaver\Common\Application\Handler\Query
 */
class MetaQueryHandler extends AbstractHandler
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param  MetaQuery|CommandInterface  $query
     */
    public function handle(CommandInterface $query): void
    {
        // TODO: Implement handle() method.
    }
} 