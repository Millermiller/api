<?php


namespace Scandinaver\Learn\Application\Handler\Command;

use League\Fractal\Resource\Item;
use Scandinaver\Learn\Domain\Exception\LanguageNotFoundException;
use Scandinaver\Learn\Domain\Service\{AssetService, CardService};
use Scandinaver\Learn\UI\Command\CreateAssetCommand;
use Scandinaver\Learn\UI\Resource\AssetTransformer;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class CreateAssetCommandHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Command
 */
class CreateAssetCommandHandler extends AbstractHandler
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
     * @param  CreateAssetCommand|CommandInterface  $command
     *
     * @throws LanguageNotFoundException
     */
    public function handle(CommandInterface $command): void
    {
        $asset = $this->assetService->create($command->getUser(), $command->getData());

        $this->fractal->parseIncludes('cards');

        $this->resource = new Item($asset, new AssetTransformer());
    }
}