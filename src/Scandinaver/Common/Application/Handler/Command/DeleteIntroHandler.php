<?php


namespace Scandinaver\Common\Application\Handler\Command;

use Scandinaver\Common\Domain\Contract\Command\DeleteIntroHandlerInterface;
use Scandinaver\Common\Domain\Exception\IntroNotFoundException;
use Scandinaver\Common\Domain\Services\IntroService;
use Scandinaver\Common\UI\Command\DeleteIntroCommand;
use Scandinaver\Shared\Contract\Command;

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
     * @param  DeleteIntroCommand|Command  $command
     *
     * @throws IntroNotFoundException
     */
    public function handle($command): void
    {
        $this->service->delete($command->getId());
    }
} 