<?php


namespace Scandinaver\Learn\UI\Command;

use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\Shared\Contract\Command;
use Scandinaver\User\Domain\Model\User;

/**
 * Class CreateCardCommand
 *
 * @package Scandinaver\Learn\UI\Command
 *
 * @see     \Scandinaver\Learn\Application\Handler\Command\CreateCardHandler
 */
class CreateCardCommand implements Command
{
    private User $user;

    private string $languageId;

    private string $word;

    private string $translate;

    public function __construct(User $user, string $languageId, string $word, string $translate)
    {
        $this->user      = $user;
        $this->language  = $language;
        $this->word      = $word;
        $this->translate = $translate;
    }

    public function getLanguage(): Language
    {
        return $this->language;
    }

    public function getUser(): User
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
}