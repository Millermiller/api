<?php


namespace Scandinaver\Common\Application\Handler\Query;

use League\Fractal\Resource\Collection;
use Scandinaver\Common\Domain\Service\IntroService;
use Scandinaver\Common\UI\Query\IntrosQuery;
use Scandinaver\Common\UI\Resource\IntroTransformer;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\BaseCommandInterface;

/**
 * Class IntrosQueryHandler
 *
 * @package Scandinaver\Common\Application\Handler\Query
 */
class IntrosQueryHandler extends AbstractHandler
{
    private IntroService $introService;

    public function __construct(IntroService $introService)
    {
        parent::__construct();

        $this->introService = $introService;
    }

    /**
     * @param  IntrosQuery|BaseCommandInterface  $query
     */
    public function handle(BaseCommandInterface $query): void
    {
        $intros = $this->introService->all();

        $this->resource = new Collection($intros, new IntroTransformer());
    }
}