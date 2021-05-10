<?php


namespace Scandinaver\Learn\UI\Command;

use Scandinaver\Common\Domain\Contract\UserInterface;
use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\Shared\Contract\CommandInterface;
use Scandinaver\Shared\DTO;

/**
 * Class CreateCardCommand
 *
 * @package Scandinaver\Learn\UI\Command
 *
 * @see     \Scandinaver\Learn\Application\Handler\Command\CreateCardCommandHandler
 */
class CreateCardCommand implements CommandInterface
{
    private UserInterface $user;

    private string $languageId;

    private string $word;

    private string $translate;

    public function __construct(UserInterface $user, string $languageId, string $word, string $translate)
    {
        $this->user      = $user;
        $this->word      = $word;
        $this->translate = $translate;
    }

    public function getLanguage(): Language
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