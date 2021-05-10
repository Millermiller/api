<?php


namespace Scandinaver\Common\Application\Handler\Command;

use League\Fractal\Resource\Item;
use Scandinaver\Common\Domain\Service\LanguageService;
use Scandinaver\Common\UI\Command\CreateLanguageCommand;
use Scandinaver\Common\UI\Resource\LanguageTransformer;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\BaseCommandInterface;

/**
 * Class CreateLanguageCommandHandler
 *
 * @package Scandinaver\Common\Application\Handler\Command
 */
class CreateLanguageCommandHandler extends AbstractHandler
{

    private LanguageService $languageService;

    public function __construct(LanguageService $languageService)
    {
        parent::__construct();
        $this->languageService = $languageService;
    }

    /**
     * @param CreateLanguageCommand|BaseCommandInterface $command
     */
    public function handle(BaseCommandInterface $command): void
    {
        $language = $this->languageService->createLanguage($command->getData());

        $this->resource = new Item($language, new LanguageTransformer());
    }
} 