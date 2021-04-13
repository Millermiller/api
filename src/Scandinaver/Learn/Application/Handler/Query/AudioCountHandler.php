<?php


namespace Scandinaver\Learn\Application\Handler\Query;

use League\Fractal\Resource\Primitive;
use Scandinaver\Learn\Domain\Contract\Query\AudioCountHandlerInterface;
use Scandinaver\Learn\Domain\Services\AudioService;
use Scandinaver\Learn\UI\Query\AudioCountQuery;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\Query;

/**
 * Class AudioCountHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Query
 */
class AudioCountHandler extends AbstractHandler implements AudioCountHandlerInterface
{
    private AudioService $audioService;

    public function __construct(AudioService $audioService)
    {
        parent::__construct();

        $this->audioService = $audioService;
    }

    /**
     * @param  AudioCountQuery|Query  $query
     *
     * @return int
     */
    public function handle($query): void
    {
        $count = $this->audioService->count();

        $this->resource = new Primitive($count);
    }
}