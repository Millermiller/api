<?php


namespace Scandinaver\Learning\Asset\Application\Handler\Query;

use League\Fractal\Resource\Primitive;
use Scandinaver\Learning\Asset\Domain\Service\AudioService;
use Scandinaver\Learning\Asset\UI\Query\AudioCountQuery;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\BaseCommandInterface;

/**
 * Class AudioCountQueryHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Query
 */
class AudioCountQueryHandler extends AbstractHandler
{

    public function __construct(private AudioService $audioService)
    {
        parent::__construct();
    }

    /**
     * @param  AudioCountQuery  $query
     */
    public function handle(BaseCommandInterface $query): void
    {
        $count = $this->audioService->count();

        $this->resource = new Primitive($count);
    }
}