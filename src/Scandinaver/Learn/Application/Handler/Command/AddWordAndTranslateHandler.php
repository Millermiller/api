<?php


namespace Scandinaver\Learn\Application\Handler\Command;

use League\Fractal\Resource\NullResource;
use Scandinaver\Learn\Domain\Contract\Command\AddWordAndTranslateHandlerInterface;
use Scandinaver\Learn\Domain\Services\WordService;
use Scandinaver\Learn\UI\Command\AddWordAndTranslateCommand;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\Command;

/**
 * Class AddWordAndTranslateHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Command
 */
class AddWordAndTranslateHandler extends AbstractHandler implements AddWordAndTranslateHandlerInterface
{
    private WordService $wordService;

    public function __construct(WordService $wordService)
    {
        parent::__construct();

        $this->wordService = $wordService;
    }

    /**
     * @param  AddWordAndTranslateCommand|Command  $command
     */
    public function handle($command): void
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