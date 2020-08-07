<?php


namespace Scandinaver\Learn\UI\Command;

use Scandinaver\Common\Domain\Model\Language;
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
     * @param  Language  $language
     * @param  User      $user
     * @param  int       $id
     */
    public function __construct(Language $language, User $user, int $id)
    {
        $this->language = $language;
        $this->user = $user;
        $this->id = $id;
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