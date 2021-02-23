<?php


namespace Scandinaver\Learn\Application\Handler\Command;

use Scandinaver\Learn\Domain\Contract\Command\CreateAssetHandlerInterface;
use Scandinaver\Learn\Domain\Exceptions\LanguageNotFoundException;
use Scandinaver\Learn\Domain\Model\AssetDTO;
use Scandinaver\Learn\Domain\Services\{AssetService, CardService};
use Scandinaver\Learn\UI\Command\CreateAssetCommand;
use Scandinaver\Shared\Contract\Command;

/**
 * Class CreateAssetHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Command
 */
class CreateAssetHandler implements CreateAssetHandlerInterface
{
    protected CardService $cardService;

    protected AssetService $assetService;

    public function __construct(AssetService $assetService, CardService $cardService)
    {
        $this->assetService = $assetService;
        $this->cardService = $cardService;
    }

    /**
     * @param  CreateAssetCommand|Command  $command
     *
     * @return AssetDTO
     * @throws LanguageNotFoundException
     */
    public function handle($command): AssetDTO
    {
        return $this->assetService->create($command->getLanguage(), $command->getUser(), $command->getTitle());
    }
}