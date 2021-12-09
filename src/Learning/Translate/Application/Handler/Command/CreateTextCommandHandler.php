<?php


namespace Scandinaver\Learning\Translate\Application\Handler\Command;

use League\Fractal\Resource\Item;
use Scandinaver\Learning\Asset\Domain\Exception\LanguageNotFoundException;
use Scandinaver\Learning\Translate\Domain\Service\TextService;
use Scandinaver\Learning\Translate\UI\Command\CreateTextCommand;
use Scandinaver\Learning\Translate\UI\Resource\TextTransformer;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\CommandInterface;

/**
 * Class CreateTextCommandHandler
 *
 * @package Scandinaver\Translate\Application\Handler\Command
 */
class CreateTextCommandHandler extends AbstractHandler
{

    public function __construct(private TextService $textService)
    {
        parent::__construct();
    }

    /**
     * @param  CommandInterface|CreateTextCommand  $command
     *
     * @throws LanguageNotFoundException
     */
    public function handle(CommandInterface|CreateTextCommand $command): void
    {
        $text = $this->textService->createText($command->buildDTO());

        $this->resource = new Item($text, new TextTransformer());
    }
} 