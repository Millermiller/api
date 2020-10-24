<?php


namespace Scandinaver\Learn\Application\Handler\Command;

use Scandinaver\Learn\Domain\Model\Card;
use Scandinaver\Learn\Domain\Services\CardService;
use Scandinaver\Learn\UI\Command\CreateCardCommand;
use Scandinaver\Learn\Domain\Contract\Command\CreateCardHandlerInterface;

/**
 * Class CreateCardHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Command
 */
class CreateCardHandler implements CreateCardHandlerInterface
{
    private CardService $service;

    public function __construct(CardService $service)
    {
        $this->service = $service;
    }

    /**
     * @param  CreateCardCommand  $command
     *
     * @return Card
     */
    public function handle($command): Card
    {
        return $this->service->createCard(
            $command->getUser(),
            $command->getLanguage(),
            $command->getWord(),
            $command->getTranslate()
        );
    }
} 