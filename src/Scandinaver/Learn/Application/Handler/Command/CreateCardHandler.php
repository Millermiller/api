<?php


namespace Scandinaver\Learn\Application\Handler\Command;

use League\Fractal\Resource\Item;
use Scandinaver\Learn\Domain\Contract\Command\CreateCardHandlerInterface;
use Scandinaver\Learn\Domain\Exceptions\LanguageNotFoundException;
use Scandinaver\Learn\Domain\Services\CardService;
use Scandinaver\Learn\UI\Command\CreateCardCommand;
use Scandinaver\Learn\UI\Resources\CardTransformer;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\Command;

/**
 * Class CreateCardHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Command
 */
class CreateCardHandler extends AbstractHandler implements CreateCardHandlerInterface
{
    private CardService $service;

    public function __construct(CardService $service)
    {
        parent::__construct();

        $this->service = $service;
    }

    /**
     * @param  CreateCardCommand|Command  $command
     *
     * @throws LanguageNotFoundException
     */
    public function handle($command): void
    {
        $card =  $this->service->createCard(
            $command->getUser(),
            $command->getLanguage(),
            $command->getWord(),
            $command->getTranslate()
        );

        $this->resource = new Item($card, new CardTransformer());
    }
} 