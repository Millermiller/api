<?php


namespace Scandinaver\Learning\Translate\Application\Handler\Command;

use League\Fractal\Resource\Item;
use Scandinaver\Shared\Contract\CommandInterface;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Learning\Translate\Domain\Service\TextService;
use Scandinaver\Learning\Translate\UI\Command\UploadTextImageCommand;

/**
 * Class UploadTextImageCommandHandler
 *
 * @package Scandinaver\Translate\Application\Handler\Command
 */
class UploadTextImageCommandHandler extends AbstractHandler
{

    private TextService $textService;

    public function __construct(TextService $textService)
    {
        parent::__construct();
        $this->textService = $textService;
    }

    /**
     * @param UploadTextImageCommand|CommandInterface $command
     */
    public function handle($command): void
    {
        $path = $this->textService->saveImage($command->getId(), $command->getPhoto());

        $this->resource = new Item($path, fn($data) => ['path' => $data]);
    }
} 