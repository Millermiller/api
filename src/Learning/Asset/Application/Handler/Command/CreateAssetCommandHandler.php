<?php


namespace Scandinaver\Learning\Asset\Application\Handler\Command;

use Exception;
use League\Fractal\Resource\Item;
use Scandinaver\Learning\Asset\Domain\Service\{AssetService};
use Scandinaver\Learning\Asset\UI\Command\CreateAssetCommand;
use Scandinaver\Learning\Asset\UI\Resource\AssetTransformer;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\CommandInterface;

/**
 * Class CreateAssetCommandHandler
 *
 * @package Scandinaver\Learning\Asset\Application\Handler\Command
 */
class CreateAssetCommandHandler extends AbstractHandler
{

    public function __construct(protected AssetService $service)
    {
        parent::__construct();
    }

    /**
     * @param  CreateAssetCommand  $command
     *
     * @throws Exception
     */
    public function handle(CommandInterface $command): void
    {
        $asset = $this->service->create($command->getUser(), $command->buildDTO());

        $this->fractal->parseIncludes('cards');

        $this->resource = new Item($asset, new AssetTransformer());
    }
}