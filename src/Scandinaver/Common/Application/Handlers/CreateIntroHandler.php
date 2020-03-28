<?php


namespace Scandinaver\Common\Application\Handlers;

use Scandinaver\Common\Application\Commands\CreateIntroCommand;
use Scandinaver\Common\Domain\Services\IntroService;

/**
 * Class CreateIntroHandler
 *
 * @package Scandinaver\Common\Application\Handlers
 */
class CreateIntroHandler implements CreateIntroHandlerInterface
{
    /**
     * @var IntroService
     */
    private $introService;

    public function __construct(IntroService $introService)
    {
        $this->introService = $introService;
    }

    /**
     * @param CreateIntroCommand
     *
     * @inheritDoc
     */
    public function handle($command): void
    {
        $this->introService->create($command->getData());
    }
} 