<?php


namespace Scandinaver\Learn\Application\Commands;

use Scandinaver\Learn\Domain\{Translate, Word};
use Scandinaver\Shared\Contracts\Command;
use Scandinaver\User\Domain\User;

/**
 * Class CreateFavouriteCommand
 *
 * @package Scandinaver\Learn\Application\Commands
 * @see     \Scandinaver\Learn\Application\Handlers\CreateFavouriteHandler
 */
class CreateFavouriteCommand implements Command
{
    /**
     * @var User
     */
    private $user;

    /**
     * @var Word
     */
    private $word;

    /**
     * @var Translate
     */
    private $translate;

    /**
     * CreateFavouriteCommand constructor.
     *
     * @param User      $user
     * @param Word      $word
     * @param Translate $translate
     */
    public function __construct(User $user, Word $word, Translate $translate)
    {
        $this->user      = $user;
        $this->word      = $word;
        $this->translate = $translate;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @return Word
     */
    public function getWord(): Word
    {
        return $this->word;
    }

    /**
     * @return Translate
     */
    public function getTranslate(): Translate
    {
        return $this->translate;
    }
}