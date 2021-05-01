<?php


namespace Scandinaver\Learn\Application\Handler\Query;

use Scandinaver\Learn\UI\Query\TextsCountByLanguageQuery;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\CommandInterface;

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
     * @param  TextsCountByLanguageQuery|CommandInterface  $query
     */
    public function handle(CommandInterface $query): void
    {
        // TODO: Implement handle() method.
    }
} 