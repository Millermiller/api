<?php


namespace Scandinaver\Learning\Translate\Application\Handler\Command;

use League\Fractal\Resource\Item;
use Scandinaver\Learning\Translate\Domain\Exception\TextNotFoundException;
use Scandinaver\Learning\Translate\Domain\Service\TextService;
use Scandinaver\Learning\Translate\UI\Command\UploadTextImageCommand;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\CommandInterface;

/**
 * Class UploadTextImageCommandHandler
 *
 * @package Scandinaver\Translate\Application\Handler\Command
 */
class UploadTextImageCommandHandler extends AbstractHandler
{

    public function __construct(private TextService $textService)
    {
        parent::__construct();
    }

    /**
     * @param  CommandInterface|UploadTextImageCommand  $command
     *
     * @throws TextNotFoundException
     */
    public function handle(CommandInterface|UploadTextImageCommand $command): void
    {
        $path = $this->textService->saveImage($command->getId(), $command->getPhoto());

        $this->resource = new Item($path, fn($data) => ['path' => $data]);
    }
} 