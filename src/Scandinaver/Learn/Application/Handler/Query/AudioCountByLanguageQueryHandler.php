<?php


namespace Scandinaver\Learn\Application\Handler\Query;

use Scandinaver\Learn\UI\Query\AudioCountByLanguageQuery;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\BaseCommandInterface;
use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class AudioCountByLanguageQueryHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Query
 */
class AudioCountByLanguageQueryHandler extends AbstractHandler
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param  AudioCountByLanguageQuery|BaseCommandInterface $query
     *
     * @inheritDoc
     */
    public function handle(BaseCommandInterface $query): void
    {
        // TODO: Implement handle() method.
    }
} 