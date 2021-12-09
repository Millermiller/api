<?php


namespace Scandinaver\Common\Application\Handler\Query;

use Scandinaver\Common\UI\Query\MetaQuery;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\BaseCommandInterface;

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

    public function handle(BaseCommandInterface|MetaQuery $query): void
    {
        // TODO: Implement handle() method.
    }
} 