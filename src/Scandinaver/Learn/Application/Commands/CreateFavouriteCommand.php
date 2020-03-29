<?php


namespace Scandinaver\Learn\Application\Commands;

use Scandinaver\Common\Domain\Language;
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
     * @var Language
     */
    private $language;

    /**
     * CreateFavouriteCommand constructor.
     *
     * @param Language  $language
     * @param User      $user
     * @param Word      $word
     * @param Translate $translate
     */
    public function __construct(Language $language, User $user, Word $word, Translate $translate)
    {
        $this->language      = $language;
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

    /**
     * @return Language
     */
    public function getLanguage(): Language
    {
        return $this->language;
    }
}