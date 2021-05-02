<?php


namespace Scandinaver\Learn\Application\Handler\Query;

use League\Fractal\Resource\Primitive;
use Scandinaver\Learn\Domain\Service\AudioService;
use Scandinaver\Learn\UI\Query\AudioCountQuery;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class AudioCountQueryHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Query
 */
class AudioCountQueryHandler extends AbstractHandler
{
    private AudioService $audioService;

    public function __construct(AudioService $audioService)
    {
        parent::__construct();

        $this->audioService = $audioService;
    }

    /**
     * @param  AudioCountQuery|CommandInterface  $query
     */
    public function handle(CommandInterface $query): void
    {
        $count = $this->audioService->count();

        $this->resource = new Primitive($count);
    }
}