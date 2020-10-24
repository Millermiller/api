<?php


namespace Scandinaver\Learn\UI\Command;

use Scandinaver\Shared\Contract\Command;
use Scandinaver\User\Domain\Model\User;

/**
 * Class CreateAssetCommand
 *
 * @see     \Scandinaver\Learn\Application\Handler\Command\CreateAssetHandler
 * @package Scandinaver\Learn\UI\Command
 */
class CreateAssetCommand implements Command
{
    private User $user;

    private string $title;
    private string $language;

    public function __construct(string $language, User $user, string $title)
    {
        $this->user = $user;
        $this->title = $title;
        $this->language = $language;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getLanguage(): string
    {
        return $this->language;
    }
}