<?php


namespace Scandinaver\Learn\Application\Handler\Command;

use League\Fractal\Resource\NullResource;
use Scandinaver\Learn\Domain\Service\WordService;
use Scandinaver\Learn\UI\Command\AddWordAndTranslateCommand;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class AddWordAndTranslateCommandHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Command
 */
class AddWordAndTranslateCommandHandler extends AbstractHandler
{
    private WordService $wordService;

    public function __construct(WordService $wordService)
    {
        parent::__construct();

        $this->wordService = $wordService;
    }

    /**
     * @param  AddWordAndTranslateCommand|CommandInterface  $command
     */
    public function handle(CommandInterface $command): void
    {
        $this->wordService->create(
            config('app.lang'),
            $command->getWord(),
            $command->getIssentence(),
            $command->getTranslate()
        );

        $this->resource = new NullResource();
    }
} 