<?php


namespace Scandinaver\Learn\Application\Handler\Query;

use League\Fractal\Resource\Item;
use Scandinaver\Learn\Domain\Exception\TermNotFoundException;
use Scandinaver\Learn\Domain\Service\AudioService;
use Scandinaver\Learn\UI\Query\FindAudioQuery;
use Scandinaver\Learn\UI\Resource\TermTransformer;
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