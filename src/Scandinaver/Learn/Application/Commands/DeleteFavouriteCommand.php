<?php


namespace Scandinaver\Learn\Application\Commands;

use Scandinaver\Common\Domain\Language;
use Scandinaver\Shared\Contracts\Command;
use Scandinaver\User\Domain\User;

/**
 * Class DeleteFavouriteCommand
 *
 * @package Scandinaver\Learn\Application\Commands
 * @see     \Scandinaver\Learn\Application\Handlers\DeleteFavouriteHandler
 */
class DeleteFavouriteCommand implements Command
{
    /**
     * @var User
     */
    private $user;

    /**
     * @var int
     */
    private $id;

    /**
     * @var Language
     */
    private $language;

    /**
     * CreateFavouriteCommand constructor.
     *
     * @param Language $language
     * @param User     $user
     * @param int      $id
     */
    public function __construct(Language $language, User $user, int $id)
    {
        $this->language = $language;
        $this->user = $user;
        $this->id   = $id;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return Language
     */
    public function getLanguage(): Language
    {
        return $this->language;
    }
}