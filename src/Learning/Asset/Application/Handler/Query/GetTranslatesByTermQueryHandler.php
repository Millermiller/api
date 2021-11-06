<?php


namespace Scandinaver\Learning\Asset\Application\Handler\Query;

use League\Fractal\Resource\Collection;
use Scandinaver\Learning\Asset\Domain\Service\TermService;
use Scandinaver\Learning\Asset\UI\Query\GetTranslatesByTermQuery;
use Scandinaver\Learning\Asset\UI\Resource\TranslateTransformer;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\BaseCommandInterface;

/**
 * Class GetTranslatesByWordHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Query
 */
class GetTranslatesByTermQueryHandler extends AbstractHandler
{
    private TermService $termService;

    public function __construct(TermService $termService)
    {
        parent::__construct();

        $this->termService = $termService;
    }

    /**
     * @param  GetTranslatesByTermQuery|BaseCommandInterface  $query
     */
    public function handle(BaseCommandInterface $query): void
    {
        $translates = $this->termService->getTranslates($query->getId());

        $this->resource = new Collection($translates, new TranslateTransformer());
    }
} 