<?php


namespace Scandinaver\Learn\Application\Handler\Query;

use League\Fractal\Resource\Item;
use Scandinaver\Learn\Domain\Service\TermService;
use Scandinaver\Learn\UI\Query\TermsCountQuery;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\BaseCommandInterface;

/**
 * Class TermsCountQueryHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Query
 */
class TermsCountQueryHandler extends AbstractHandler
{
    private TermService $termService;

    public function __construct(TermService $termService)
    {
        parent::__construct();

        $this->termService = $termService;
    }

    /**
     * @param  TermsCountQuery|BaseCommandInterface  $query
     */
    public function handle(BaseCommandInterface $query): void
    {
        $count = $this->termService->count();

        $this->resource =new Item($count, fn($data) => ['count' => $data]);
    }
}