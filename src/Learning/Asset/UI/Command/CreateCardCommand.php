<?php


namespace Scandinaver\Learning\Asset\UI\Command;

use Scandinaver\Common\Domain\Contract\UserInterface;
use Scandinaver\Common\Domain\Entity\Language;
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

    private string $word;

    private string $translate;

    private string $language;

    public function __construct(UserInterface $user, string $language, string $word, string $translate)
    {
        $this->user      = $user;
        $this->word      = $word;
        $this->translate = $translate;
        $this->language  = $language;
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