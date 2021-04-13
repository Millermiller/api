<?php


namespace Scandinaver\Learn\Application\Handler\Query;


use Scandinaver\Learn\Domain\Contract\Query\TextsCountByLanguageHandlerInterface;
use Scandinaver\Learn\UI\Query\TextsCountByLanguageQuery;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\Query;

/**
 * Class TextsCountByLanguageHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Query
 */
class TextsCountByLanguageHandler extends AbstractHandler implements TextsCountByLanguageHandlerInterface
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param  TextsCountByLanguageQuery|Query  $query
     */
    public function handle($query): void
    {
        // TODO: Implement handle() method.
    }
} 