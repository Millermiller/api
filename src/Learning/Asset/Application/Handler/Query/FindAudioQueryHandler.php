<?php


namespace Scandinaver\Learning\Asset\Application\Handler\Query;

use League\Fractal\Resource\Item;
use Scandinaver\Learning\Asset\Domain\Exception\TermNotFoundException;
use Scandinaver\Learning\Asset\Domain\Service\AudioService;
use Scandinaver\Learning\Asset\UI\Query\FindAudioQuery;
use Scandinaver\Learning\Asset\UI\Resource\TermTransformer;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\BaseCommandInterface;

/**
 * Class FindAudioQueryHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Query
 */
class FindAudioQueryHandler extends AbstractHandler
{
    private AudioService $audioService;

    public function __construct(AudioService $audioService)
    {
        parent::__construct();

        $this->audioService = $audioService;
    }

    /**
     * @param  FindAudioQuery|BaseCommandInterface  $query
     *
     * @throws TermNotFoundException
     */
    public function handle(BaseCommandInterface $query): void
    {
        $term = $this->audioService->parse($query->getId());

        $this->resource = new Item($term, new TermTransformer());
    }
} 