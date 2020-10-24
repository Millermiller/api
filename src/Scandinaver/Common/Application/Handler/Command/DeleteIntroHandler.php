<?php


namespace Scandinaver\Common\Application\Handler\Command;

use Scandinaver\Common\Domain\Services\IntroService;
use Scandinaver\Common\UI\Command\DeleteIntroCommand;
use Scandinaver\Common\Domain\Contract\Command\DeleteIntroHandlerInterface;

/**
 * Class DeleteIntroHandler
 *
 * @package Scandinaver\Common\Application\Handler\Command
 */
class DeleteIntroHandler implements DeleteIntroHandlerInterface
{

    private IntroService $service;

    public function __construct(IntroService $service)
    {
        $this->service = $service;
    }

    /**
     * @param DeleteIntroCommand $command
     */
    public function handle($command): void
    {
        $this->service->delete($command->getId());
    }
} 