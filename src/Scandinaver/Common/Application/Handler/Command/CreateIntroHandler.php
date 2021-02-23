<?php


namespace Scandinaver\Common\Application\Handler\Command;

use Scandinaver\Common\Domain\Contract\Command\CreateIntroHandlerInterface;
use Scandinaver\Common\Domain\Model\IntroDTO;
use Scandinaver\Common\Domain\Services\IntroService;
use Scandinaver\Common\UI\Command\CreateIntroCommand;
use Scandinaver\Shared\Contract\Command;

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
     * @param  CreateIntroCommand|Command  $command
     *
     * @return IntroDTO
     */
    public function handle($command): IntroDTO
    {
        return $this->introService->create($command->getData());
    }
} 