<?php


namespace Scandinaver\Common\Application\Handler\Query;

use League\Fractal\Resource\Item;
use Scandinaver\Common\Domain\Exception\IntroNotFoundException;
use Scandinaver\Common\Domain\Service\IntroService;
use Scandinaver\Common\UI\Query\IntroQuery;
use Scandinaver\Common\UI\Resource\IntroTransformer;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class IntroQueryHandler
 *
 * @package Scandinaver\Common\Application\Handler\Query
 */
class IntroQueryHandler extends AbstractHandler
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
     * @param  IntroQuery|CommandInterface  $query
     *
     * @throws IntroNotFoundException
     */
    public function handle(CommandInterface $query): void
    {
        $intro = $this->introService->one($query->getId());

        $this->resource = new Item($intro, new IntroTransformer());
    }
}