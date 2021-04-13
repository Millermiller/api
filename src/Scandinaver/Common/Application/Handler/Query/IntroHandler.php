<?php


namespace Scandinaver\Common\Application\Handler\Query;

use League\Fractal\Resource\Item;
use Scandinaver\Common\Domain\Contract\Query\IntroHandlerInterface;
use Scandinaver\Common\Domain\Exception\IntroNotFoundException;
use Scandinaver\Common\Domain\Services\IntroService;
use Scandinaver\Common\UI\Query\IntroQuery;
use Scandinaver\Common\UI\Resources\IntroTransformer;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\Query;

/**
 * Class MessagesHandler
 *
 * @package Scandinaver\Common\Application\Handler\Query
 */
class IntroHandler extends AbstractHandler implements IntroHandlerInterface
{
    private IntroService $introService;

    /**
     * MessagesHandler constructor.
     *
     * @param  IntroService  $introService
     */
    public function __construct(IntroService $introService)
    {
        parent::__construct();

        $this->introService = $introService;
    }

    /**
     * @param  IntroQuery|Query  $query
     *
     * @throws IntroNotFoundException
     */
    public function handle($query): void
    {
        $intro = $this->introService->one($query->getId());

        $this->resource = new Item($intro, new IntroTransformer());
    }
}