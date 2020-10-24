<?php


namespace Scandinaver\Learn\UI\Command;

use Scandinaver\Shared\Contract\Command;
use Scandinaver\User\Domain\Model\User;

/**
 * Class DeleteFavouriteCommand
 *
 * @see     \Scandinaver\Learn\Application\Handler\Command\DeleteFavouriteHandler
 * @package Scandinaver\Learn\UI\Command
 */
class DeleteFavouriteCommand implements Command
{
    private User $user;

    private string $language;

    private int $card;

    public function __construct(string $language, User $user, int $card)
    {
        $this->language = $language;
        $this->user = $user;
        $this->card = $card;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getLanguage(): string
    {
        return $this->language;
    }

    public function getCard(): int
    {
        return $this->card;
    }
}