<?php


namespace Scandinaver\Learn\Application\Handler\Command;

use Scandinaver\Learn\Domain\Services\CardService;
use Scandinaver\Learn\UI\Command\FillDictionaryCommand;
use Scandinaver\Learn\Domain\Contract\Command\FillDictionaryHandlerInterface;

/**
 * Class FillDictionaryHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Command
 */
class FillDictionaryHandler implements FillDictionaryHandlerInterface
{
    private CardService $cardCervice;

    public function __construct(CardService $cardCervice)
    {
        $this->cardCervice = $cardCervice;
    }

    /**
     * @param  FillDictionaryCommand  $command
     */
    public function handle($command): void
    {
        $this->cardCervice->fillDictionary($command->getLanguage(), $command->getWord());
    }
} 