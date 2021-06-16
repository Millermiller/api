<?php


namespace Scandinaver\Translate\Application\Handler\Command;

use League\Fractal\Resource\Item;
use Scandinaver\Shared\Contract\CommandInterface;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Translate\Domain\Service\TextService;
use Scandinaver\Translate\UI\Command\UploadTextImageCommand;

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