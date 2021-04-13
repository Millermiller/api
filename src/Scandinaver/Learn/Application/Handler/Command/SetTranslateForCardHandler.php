<?php


namespace Scandinaver\Learn\Application\Handler\Command;

use Scandinaver\Learn\Domain\Contract\Command\SetTranslateForCardHandlerInterface;
use Scandinaver\Learn\Domain\Services\CardService;
use Scandinaver\Learn\UI\Command\SetTranslateForCardCommand;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\Command;

/**
 * Class SetTranslateForCardHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Command
 */
class SetTranslateForCardHandler extends AbstractHandler implements SetTranslateForCardHandlerInterface
{
    private CardService $cardService;

    public function __construct(CardService $cardService)
    {
        parent::__construct();

        $this->cardService = $cardService;
    }

    /**
     * @param  SetTranslateForCardCommand|Command  $command
     */
    public function handle($command): void
    {
        //
    }
} 