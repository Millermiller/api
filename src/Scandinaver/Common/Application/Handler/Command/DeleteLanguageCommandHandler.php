<?php


namespace Scandinaver\Common\Application\Handler\Command;

use League\Fractal\Resource\NullResource;
use Scandinaver\Common\Domain\Service\LanguageService;
use Scandinaver\Common\UI\Command\DeleteLanguageCommand;
use Scandinaver\Learn\Domain\Exception\LanguageNotFoundException;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\BaseCommandInterface;

/**
 * Class DeleteLanguageCommandHandler
 *
 * @package Scandinaver\Common\Application\Handler\Command
 */
class DeleteLanguageCommandHandler extends AbstractHandler
{

    private LanguageService $languageService;

    public function __construct(LanguageService $languageService)
    {
        parent::__construct();

        $this->languageService = $languageService;
    }

    /**
     * @param  DeleteLanguageCommand|BaseCommandInterface  $command
     *
     * @throws LanguageNotFoundException
     */
    public function handle(BaseCommandInterface $command): void
    {
        $this->languageService->deleteLanguage($command->getId());

        $this->resource = new NullResource();
    }
} 