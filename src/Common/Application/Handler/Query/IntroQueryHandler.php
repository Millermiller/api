<?php


namespace Scandinaver\Common\Application\Handler\Query;

use League\Fractal\Resource\Item;
use Scandinaver\Common\Domain\Exception\IntroNotFoundException;
use Scandinaver\Common\Domain\Service\IntroService;
use Scandinaver\Common\UI\Query\IntroQuery;
use Scandinaver\Common\UI\Resource\IntroTransformer;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\BaseCommandInterface;

/**
 * Class IntroQueryHandler
 *
 * @package Scandinaver\Common\Application\Handler\Query
 */
class IntroQueryHandler extends AbstractHandler
{

    public function __construct(private IntroService $service)
    {
        parent::__construct();
    }

    /**
     * @param  IntroQuery  $query
     *
     * @throws IntroNotFoundException
     */
    public function handle(BaseCommandInterface $query): void
    {
        $intro = $this->service->one($query->getId());

        $this->resource = new Item($intro, new IntroTransformer());
    }
}