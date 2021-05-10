<?php


namespace Scandinaver\Common\Application\Handler\Command;

use League\Fractal\Resource\Item;
use Scandinaver\Common\Domain\Service\LanguageService;
use Scandinaver\Common\UI\Command\UpdateLanguageCommand;
use Scandinaver\Common\UI\Resource\LanguageTransformer;
use Scandinaver\Learn\Domain\Exception\LanguageNotFoundException;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\BaseCommandInterface;

/**
 * Class UpdateLanguageCommandHandler
 *
 * @package Scandinaver\Common\Application\Handler\Command
 */
class UpdateLanguageCommandHandler extends AbstractHandler
{

    private LanguageService $languageService;

    public function __construct(LanguageService $languageService)
    {
        parent::__construct();

        $this->languageService = $languageService;
    }

    /**
     * @param  UpdateLanguageCommand|BaseCommandInterface  $command
     *
     * @throws LanguageNotFoundException
     */
    public function handle(BaseCommandInterface $command): void
    {
        $language = $this->languageService->updateLanguage($command->getId(), $command->getData());

        $this->resource = new Item($language, new LanguageTransformer());
    }
} 