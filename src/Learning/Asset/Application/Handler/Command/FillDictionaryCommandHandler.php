<?php


namespace Scandinaver\Learning\Asset\Application\Handler\Command;

use League\Fractal\Resource\NullResource;
use Scandinaver\Learning\Asset\Domain\Exception\LanguageNotFoundException;
use Scandinaver\Learning\Asset\Domain\Service\CardService;
use Scandinaver\Learning\Asset\UI\Command\FillDictionaryCommand;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\CommandInterface;

/**
 * Class FillDictionaryCommandHandler
 *
 * @package Scandinaver\Learning\Asset\Application\Handler\Command
 */
class FillDictionaryCommandHandler extends AbstractHandler
{

    public function __construct(private CardService $cardService)
    {
        parent::__construct();
    }

    /**
     * @param  FillDictionaryCommand  $command
     *
     * @throws LanguageNotFoundException
     */
    public function handle(CommandInterface $command): void
    {
        $this->cardService->fillDictionary($command->getLanguage(), $command->getTermId());

        $this->resource = new NullResource();
    }
} 