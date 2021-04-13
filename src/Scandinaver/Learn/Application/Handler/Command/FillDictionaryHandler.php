<?php


namespace Scandinaver\Learn\Application\Handler\Command;

use League\Fractal\Resource\NullResource;
use Scandinaver\Learn\Domain\Contract\Command\FillDictionaryHandlerInterface;
use Scandinaver\Learn\Domain\Exceptions\LanguageNotFoundException;
use Scandinaver\Learn\Domain\Services\CardService;
use Scandinaver\Learn\UI\Command\FillDictionaryCommand;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\Command;

/**
 * Class FillDictionaryHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Command
 */
class FillDictionaryHandler extends AbstractHandler implements FillDictionaryHandlerInterface
{
    private CardService $cardService;

    public function __construct(CardService $cardService)
    {
        parent::__construct();

        $this->cardService = $cardService;
    }

    /**
     * @param  FillDictionaryCommand|Command  $command
     *
     * @throws LanguageNotFoundException
     */
    public function handle($command): void
    {
        $this->cardService->fillDictionary($command->getLanguage(), $command->getWord());

        $this->resource = new NullResource();
    }
} 