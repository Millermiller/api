<?php


namespace Scandinaver\Translate\Application\Handler\Command;

use League\Fractal\Resource\Item;
use Scandinaver\Shared\Contract\CommandInterface;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Translate\Domain\Exception\TextNotFoundException;
use Scandinaver\Translate\Domain\Service\TextService;
use Scandinaver\Translate\UI\Command\UpdateTextCommand;
use Scandinaver\Translate\UI\Resource\TextTransformer;

/**
 * Class UpdateTextCommandHandler
 *
 * @package Scandinaver\Translate\Application\Handler\Command
 */
class UpdateTextCommandHandler extends AbstractHandler
{

    private TextService $textService;

    public function __construct(TextService $textService)
    {
        parent::__construct();

        $this->textService = $textService;
    }

    /**
     * @param  UpdateTextCommand|CommandInterface  $command
     *
     * @throws TextNotFoundException
     */
    public function handle($command): void
    {
        $text = $this->textService->updateText($command->getId(), $command->buildDTO());

        $this->resource = new Item($text, new TextTransformer());
    }
} 