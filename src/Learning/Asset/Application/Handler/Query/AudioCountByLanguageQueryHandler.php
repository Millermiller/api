<?php


namespace Scandinaver\Learning\Asset\Application\Handler\Query;

use Scandinaver\Learning\Asset\UI\Query\AudioCountByLanguageQuery;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\BaseCommandInterface;

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
     * @param  AudioCountByLanguageQuery|BaseCommandInterface  $query
     *
     * @inheritDoc
     */
    public function handle(BaseCommandInterface $query): void
    {
        // TODO: Implement handle() method.
    }
} 