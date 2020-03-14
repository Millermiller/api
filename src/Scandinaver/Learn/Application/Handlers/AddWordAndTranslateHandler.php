<?php


namespace Scandinaver\Learn\Application\Handlers;

use Scandinaver\Learn\Application\Commands\AddWordAndTranslateCommand;
use Scandinaver\Learn\Domain\Services\WordService;

/**
 * Class AddWordAndTranslateHandler
 * @package Scandinaver\Learn\Application\Handlers
 */
class AddWordAndTranslateHandler implements AddWordAndTranslateHandlerInterface
{
    /**
     * @var WordService
     */
    private $wordService;

    public function __construct(WordService $wordService)
    {
        $this->wordService = $wordService;
    }

    /**
     * @param AddWordAndTranslateCommand $command
     * @inheritDoc   $translate = new Translate(['value' => $translate, 'sentence' => $issentence, 'word_id' => $word->id]);
     */
    public function handle($command): void
    {
        $this->wordService->create(config('app.lang'), $command->getWord(), $command->getIssentence(), $command->getTranslate());
    }
} 