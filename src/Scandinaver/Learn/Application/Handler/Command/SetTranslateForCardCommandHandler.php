<?php


namespace Scandinaver\Learn\Application\Handler\Command;

use Scandinaver\Learn\Domain\Service\CardService;
use Scandinaver\Learn\UI\Command\SetTranslateForCardCommand;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\BaseCommandInterface;

/**
 * Class SetTranslateForCardHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Command
 */
class SetTranslateForCardCommandHandler extends AbstractHandler
{
    private CardService $cardService;

    public function __construct(CardService $cardService)
    {
        parent::__construct();

        $this->cardService = $cardService;
    }

    /**
     * @param  SetTranslateForCardCommand|BaseCommandInterface  $command
     */
    public function handle(BaseCommandInterface $command): void
    {
        //
    }
} 