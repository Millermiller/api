<?php


namespace Scandinaver\Learning\Asset\Application\Handler\Query;

use League\Fractal\Resource\Collection;
use Scandinaver\Learning\Asset\Domain\Service\TermService;
use Scandinaver\Learning\Asset\UI\Query\GetTranslatesByTermQuery;
use Scandinaver\Learning\Asset\UI\Resource\TranslateTransformer;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\BaseCommandInterface;

/**
 * Class GetTranslatesByWordHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Query
 */
class GetTranslatesByTermQueryHandler extends AbstractHandler
{

    public function __construct(private TermService $termService)
    {
        parent::__construct();
    }

    /**
     * @param  BaseCommandInterface|GetTranslatesByTermQuery  $query
     */
    public function handle(BaseCommandInterface|GetTranslatesByTermQuery $query): void
    {
        $translates = $this->termService->getTranslates($query->getId());

        $this->resource = new Collection($translates, new TranslateTransformer());
    }
} 