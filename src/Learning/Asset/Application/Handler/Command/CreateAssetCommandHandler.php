<?php


namespace Scandinaver\Learning\Asset\Application\Handler\Command;

use Exception;
use League\Fractal\Resource\Item;
use Scandinaver\Learning\Asset\Domain\Exception\LanguageNotFoundException;
use Scandinaver\Learning\Asset\Domain\Service\{AssetService, CardService};
use Scandinaver\Learning\Asset\UI\Command\CreateAssetCommand;
use Scandinaver\Learning\Asset\UI\Resource\AssetTransformer;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\BaseCommandInterface;

/**
 * Class CreateAssetCommandHandler
 *
 * @package Scandinaver\Learning\Asset\Application\Handler\Command
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
     * @param  CreateAssetCommand|BaseCommandInterface  $command
     *
     * @throws Exception
     */
    public function handle(BaseCommandInterface $command): void
    {
        $asset = $this->assetService->create($command->getUser(), $command->buildDTO());

        $this->fractal->parseIncludes('cards');

        $this->resource = new Item($asset, new AssetTransformer());
    }
}