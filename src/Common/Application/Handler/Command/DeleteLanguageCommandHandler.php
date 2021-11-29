<?php


namespace Scandinaver\Common\Application\Handler\Command;

use League\Fractal\Resource\NullResource;
use Scandinaver\Common\Domain\Service\LanguageService;
use Scandinaver\Common\UI\Command\DeleteLanguageCommand;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\CommandInterface;
use Scandinaver\Learning\Asset\Domain\Exception\LanguageNotFoundException;

/**
 * Class DeleteLanguageCommandHandler
 *
 * @package Scandinaver\Common\Application\Handler\Command
 */
class DeleteLanguageCommandHandler extends AbstractHandler
{

    public function __construct(private LanguageService $service)
    {
        parent::__construct();
    }

    /**
     * @param  DeleteLanguageCommand  $command
     *
     * @throws LanguageNotFoundException
     */
    public function handle(CommandInterface $command): void
    {
        $this->service->deleteLanguage($command->getId());

        $this->resource = new NullResource();
    }
} 