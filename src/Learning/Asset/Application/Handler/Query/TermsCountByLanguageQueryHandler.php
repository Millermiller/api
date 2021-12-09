<?php


namespace Scandinaver\Learning\Asset\Application\Handler\Query;

use Scandinaver\Learning\Asset\UI\Query\TermCountByLanguageQuery;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\BaseCommandInterface;

/**
 * Class TermsCountByLanguageQueryHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Query
 */
class TermsCountByLanguageQueryHandler extends AbstractHandler
{

    public function __construct()
    {
        parent::__construct();
    }


    public function handle(BaseCommandInterface $query): void
    {
        // TODO: Implement handle() method.
    }
} 