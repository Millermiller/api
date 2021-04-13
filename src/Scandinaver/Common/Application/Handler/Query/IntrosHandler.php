<?php


namespace Scandinaver\Common\Application\Handler\Query;

use League\Fractal\Resource\Collection;
use Scandinaver\Common\Domain\Contract\Query\IntrosHandlerInterface;
use Scandinaver\Common\Domain\Services\IntroService;
use Scandinaver\Common\UI\Query\IntrosQuery;
use Scandinaver\Common\UI\Resources\IntroTransformer;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\Query;

/**
 * Class MessagesHandler
 *
 * @package Scandinaver\Common\Application\Handler\Query
 */
class IntrosHandler extends AbstractHandler implements IntrosHandlerInterface
{
    private IntroService $introService;

    public function __construct(IntroService $introService)
    {
        parent::__construct();

        $this->introService = $introService;
    }

    /**
     * @param  IntrosQuery|Query  $query
     */
    public function handle($query): void
    {
        $intros = $this->introService->all();

        $this->resource = new Collection($intros, new IntroTransformer());
    }
}