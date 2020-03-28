<?php


namespace Scandinaver\Learn\Application\Handlers;

use Scandinaver\Learn\Application\Query\AssetsCountQuery;
use Scandinaver\Learn\Domain\Services\AudioService;

/**
 * Class AssetsCountHandler
 *
 * @package Scandinaver\Learn\Application\Handlers
 */
class AssetsCountHandler implements AssetsCountHandlerInterface
{
    /**
     * @var AudioService
     */
    private $audioService;

    /**
     * WordsCountHandler constructor.
     *
     * @param AudioService $audioService
     */
    public function __construct(AudioService $audioService)
    {
        $this->audioService = $audioService;
    }

    /**
     * @param AssetsCountQuery $query
     *
     * @return int
     */
    public function handle($query): int
    {
        return $this->audioService->count($query->getLanguage());
    }
}