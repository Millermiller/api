<?php


namespace Scandinaver\Learn\Application\Handler\Command;

use League\Fractal\Resource\NullResource;
use Scandinaver\Learn\Domain\Exceptions\LanguageNotFoundException;
use Scandinaver\Learn\Domain\Services\CardService;
use Scandinaver\Learn\UI\Command\FillDictionaryCommand;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class FillDictionaryCommandHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Command
 */
class FillDictionaryCommandHandler extends AbstractHandler
{
    private CardService $cardService;

    public function __construct(CardService $cardService)
    {
        parent::__construct();

        $this->cardService = $cardService;
    }

    /**
     * @param  FillDictionaryCommand|CommandInterface  $command
     *
     * @throws LanguageNotFoundException
     */
    public function handle(CommandInterface $command): void
    {
        $this->cardService->fillDictionary($command->getLanguage(), $command->getWord());

        $this->resource = new NullResource();
    }
} 