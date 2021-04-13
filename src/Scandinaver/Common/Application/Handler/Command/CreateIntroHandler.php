<?php


namespace Scandinaver\Common\Application\Handler\Command;

use League\Fractal\Resource\Item;
use Scandinaver\Common\Domain\Contract\Command\CreateIntroHandlerInterface;
use Scandinaver\Common\Domain\Services\IntroService;
use Scandinaver\Common\UI\Command\CreateIntroCommand;
use Scandinaver\Common\UI\Resources\IntroTransformer;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\Command;

/**
 * Class CreateIntroHandler
 *
 * @package Scandinaver\Common\Application\Handler\Command
 */
class CreateIntroHandler extends AbstractHandler implements CreateIntroHandlerInterface
{
    private IntroService $introService;

    public function __construct(IntroService $introService)
    {
        parent::__construct();

        $this->introService = $introService;
    }

    /**
     * @param  CreateIntroCommand|Command  $command
     */
    public function handle($command): void
    {
        $intro = $this->introService->create($command->getData());

        $this->resource = new Item($intro, new IntroTransformer());
    }
} 