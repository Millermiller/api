<?php


namespace Scandinaver\User\Application\Handler\Query;

use Illuminate\Contracts\Container\BindingResolutionException;
use League\Fractal\Resource\Item;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\BaseCommandInterface;
use Scandinaver\Learning\Asset\Domain\Exception\LanguageNotFoundException;
use Scandinaver\User\Domain\Service\UserService;
use Scandinaver\User\UI\Query\GetStateQuery;
use Scandinaver\User\UI\Resource\StateTransformer;

/**
 * Class GetStateQueryHandler
 *
 * @package Scandinaver\User\Application\Handler\Query
 */
class GetStateQueryHandler extends AbstractHandler
{

    public function __construct(protected UserService $userService)
    {
        parent::__construct();
    }

    /**
     * @param  BaseCommandInterface|GetStateQuery  $query
     *
     * @throws BindingResolutionException
     * @throws LanguageNotFoundException
     */
    public function handle(BaseCommandInterface|GetStateQuery $query): void
    {
        $stateDTO = $this->userService->getState($query->getUser(), $query->getLanguage());

        $this->resource = new Item($stateDTO, new StateTransformer(), 'state');

        $this->fractal->parseExcludes([
            'texts.text',
            'texts.translate',
            'texts.tooltips',
            'texts.dictionary',
        ]);
    }
} 