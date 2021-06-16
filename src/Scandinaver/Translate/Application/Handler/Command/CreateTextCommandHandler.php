<?php


namespace Scandinaver\Translate\Application\Handler\Command;

use League\Fractal\Resource\Item;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\BaseCommandInterface;
use Scandinaver\Translate\Domain\Service\TextService;
use Scandinaver\Translate\UI\Command\CreateTextCommand;
use Scandinaver\Translate\UI\Resource\TextTransformer;

/**
 * Class CreateTextCommandHandler
 *
 * @package Scandinaver\Translate\Application\Handler\Command
 */
class CreateTextCommandHandler extends AbstractHandler
{

    private TextService $textService;

    public function __construct(TextService $textService)
    {
        parent::__construct();

        $this->textService = $textService;
    }

    /**
     * @param  CreateTextCommand|BaseCommandInterface  $command
     */
    public function handle(BaseCommandInterface $command): void
    {
        $text = $this->textService->createText($command->buildDTO());

        $this->resource = new Item($text, new TextTransformer());
    }
} 