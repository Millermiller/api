<?php


namespace Scandinaver\Common\Application\Handler\Command;

use Scandinaver\Common\Domain\Contract\Command\UpdateIntroHandlerInterface;
use Scandinaver\Common\Domain\Exception\IntroNotFoundException;
use Scandinaver\Common\Domain\Model\IntroDTO;
use Scandinaver\Common\Domain\Services\IntroService;
use Scandinaver\Common\UI\Command\UpdateIntroCommand;
use Scandinaver\Shared\Contract\Command;

/**
 * Class UpdateIntroHandler
 *
 * @package Scandinaver\Common\Application\Handler\Command
 */
class UpdateIntroHandler implements UpdateIntroHandlerInterface
{

    private IntroService $service;

    public function __construct(IntroService $service)
    {
        $this->service = $service;
    }

    /**
     * @param  UpdateIntroCommand|Command  $command
     *
     * @return IntroDTO
     * @throws IntroNotFoundException
     */
    public function handle($command): IntroDTO
    {
        return $this->service->update($command->getIntroId(), $command->getData());
    }
} 