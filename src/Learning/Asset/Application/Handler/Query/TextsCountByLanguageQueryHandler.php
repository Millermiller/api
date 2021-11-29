<?php


namespace Scandinaver\Learning\Asset\Application\Handler\Query;

use Scandinaver\Learning\Asset\UI\Query\TextsCountByLanguageQuery;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\BaseCommandInterface;

/**
 * Class TextsCountByLanguageQueryHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Query
 */
class TextsCountByLanguageQueryHandler extends AbstractHandler
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param  TextsCountByLanguageQuery  $query
     */
    public function handle(BaseCommandInterface $query): void
    {
        // TODO: Implement handle() method.
    }
} 