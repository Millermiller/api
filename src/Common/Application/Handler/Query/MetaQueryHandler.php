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

    /**
     * @param  MetaQuery  $query
     */
    public function handle(BaseCommandInterface $query): void
    {
        // TODO: Implement handle() method.
    }
} 