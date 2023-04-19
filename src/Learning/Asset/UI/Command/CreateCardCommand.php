<?php


namespace Scandinaver\Learning\Asset\UI\Command;

use Scandinaver\Core\Domain\Attribute\Handler;
use Scandinaver\Core\Domain\Contract\CommandInterface;
use Scandinaver\Core\Domain\Contract\UserInterface;
use Scandinaver\Core\Domain\DTO;
use Scandinaver\Learning\Asset\Application\Handler\Command\CreateCardCommandHandler;

/**
 * Class CreateCardCommand
 *
 * @package Scandinaver\Learn\UI\Command
 */
#[Handler(CreateCardCommandHandler::class)]
class CreateCardCommand implements CommandInterface
{

    public function __construct(private UserInterface $user,
                                private string $language,
                                private string $word,
                                private string $translate)
    {
    }

    public function getLanguage(): string
    {
        return $this->language;
    }

    public function getUser(): UserInterface
    {
        return $this->user;
    }

    public function getWord(): string
    {
        return $this->word;
    }

    public function getTranslate(): string
    {
        return $this->translate;
    }

    public function buildDTO(): DTO
    {
        // TODO: Implement buildDTO() method.
    }
}