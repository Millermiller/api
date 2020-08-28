<?php


namespace Scandinaver\Common\Application\Handler\Command;

use Scandinaver\Common\Domain\Contract\Command\CreateIntroHandlerInterface;
use Scandinaver\Common\Domain\Services\IntroService;
use Scandinaver\Common\UI\Command\CreateIntroCommand;

/**
 * Class CreateIntroHandler
 *
 * @package Scandinaver\Common\Application\Handler\Command
 */
class CreateIntroHandler implements CreateIntroHandlerInterface
{
    private IntroService $introService;

    public function __construct(IntroService $introService)
    {
        $this->introService = $introService;
    }

    /**
     * @param  CreateIntroCommand  $command
     *
     * @inheritDoc
     */
    public function handle($command): void
    {
        $this->introService->create($command->getData());
    }
} 