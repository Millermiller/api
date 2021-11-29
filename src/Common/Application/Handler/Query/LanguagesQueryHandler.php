<?php


namespace Scandinaver\Common\Application\Handler\Query;

use League\Fractal\Resource\Collection;
use Scandinaver\Common\Domain\Service\LanguageService;
use Scandinaver\Common\UI\Query\LanguagesQuery;
use Scandinaver\Common\UI\Resource\LanguageTransformer;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\BaseCommandInterface;

/**
 * Class LanguagesQueryHandler
 *
 * @package Scandinaver\API\Application\Handler\Query
 */
class LanguagesQueryHandler extends AbstractHandler
{

    public function __construct(private LanguageService $service)
    {
        parent::__construct();
    }

    /**
     * @param  LanguagesQuery  $query
     */
    public function handle(BaseCommandInterface $query): void
    {
        $languages = $this->service->all($query->getUser());

        $this->resource = new Collection($languages, new LanguageTransformer());
    }
}