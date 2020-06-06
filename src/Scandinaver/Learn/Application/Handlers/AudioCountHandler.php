<?php


namespace Scandinaver\Learn\Application\Handlers;

use Scandinaver\Learn\Application\Query\AudioCountQuery;
use Scandinaver\Learn\Domain\Services\AudioService;

/**
 * Class AudioCountHandler
 *
 * @package Scandinaver\Learn\Application\Handlers
 */
class AudioCountHandler implements AudioCountHandlerInterface
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
     * @param AudioCountQuery $query
     *
     * @return int
     */
    public function handle($query): int
    {
        return $this->audioService->count();
    }
}