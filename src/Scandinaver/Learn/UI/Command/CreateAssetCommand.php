<?php


namespace Scandinaver\Learn\UI\Command;

use Scandinaver\Common\Domain\Model\Language;
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

    private Language $language;

    public function __construct(Language $language, User $user, string $title)
    {
        $this->language = $language;
        $this->user = $user;
        $this->title = $title;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getLanguage(): Language
    {
        return $this->language;
    }
}