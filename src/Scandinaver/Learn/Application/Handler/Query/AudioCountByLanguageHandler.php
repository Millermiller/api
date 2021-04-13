<?php


namespace Scandinaver\Learn\Application\Handler\Query;

use Scandinaver\Learn\Domain\Contract\Query\AudioCountByLanguageHandlerInterface;
use Scandinaver\Learn\UI\Query\AudioCountByLanguageQuery;
use Scandinaver\Shared\AbstractHandler;

/**
 * Class AudioCountByLanguageHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Query
 */
class AudioCountByLanguageHandler extends AbstractHandler implements AudioCountByLanguageHandlerInterface
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param  AudioCountByLanguageQuery
     *
     * @inheritDoc
     */
    public function handle($query): void
    {
        // TODO: Implement handle() method.
    }
} 