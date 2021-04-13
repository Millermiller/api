<?php


namespace Scandinaver\Learn\Application\Handler\Command;

use League\Fractal\Resource\Item;
use Scandinaver\Learn\Domain\Contract\Command\CreateAssetHandlerInterface;
use Scandinaver\Learn\Domain\Exceptions\LanguageNotFoundException;
use Scandinaver\Learn\Domain\Services\{AssetService, CardService};
use Scandinaver\Learn\UI\Command\CreateAssetCommand;
use Scandinaver\Learn\UI\Resources\AssetTransformer;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\Command;

/**
 * Class CreateAssetHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Command
 */
class CreateAssetHandler extends AbstractHandler implements CreateAssetHandlerInterface
{
    protected CardService $cardService;

    protected AssetService $assetService;

    public function __construct(AssetService $assetService, CardService $cardService)
    {
        parent::__construct();

        $this->assetService = $assetService;
        $this->cardService = $cardService;
    }

    /**
     * @param  CreateAssetCommand|Command  $command
     *
     * @throws LanguageNotFoundException
     */
    public function handle($command): void
    {
        $asset = $this->assetService->create($command->getUser(), $command->getData());

        $this->fractal->parseIncludes('cards');

        $this->resource = new Item($asset, new AssetTransformer());
    }
}