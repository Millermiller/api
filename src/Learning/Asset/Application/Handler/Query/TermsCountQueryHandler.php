<?php


namespace Scandinaver\Learning\Asset\Application\Handler\Query;

use League\Fractal\Resource\Item;
use Scandinaver\Learning\Asset\Domain\Service\TermService;
use Scandinaver\Learning\Asset\UI\Query\TermsCountQuery;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\BaseCommandInterface;

/**
 * Class TermsCountQueryHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Query
 */
class TermsCountQueryHandler extends AbstractHandler
{

    public function __construct(private TermService $termService)
    {
        parent::__construct();
    }

    /**
     * @param  TermsCountQuery  $query
     */
    public function handle(BaseCommandInterface $query): void
    {
        $count = $this->termService->count();

        $this->resource = new Item($count, fn($data) => ['count' => $data]);
    }
}