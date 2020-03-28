<?php


namespace Scandinaver\Learn\Application\Commands;

use Scandinaver\Common\Domain\Language;
use Scandinaver\Shared\Contracts\Command;
use Scandinaver\User\Domain\User;

/**
 * Class CreateAssetCommand
 *
 * @package Scandinaver\Learn\Application\Commands
 * @see     \Scandinaver\Learn\Application\Handlers\CreateAssetHandler
 */
class CreateAssetCommand implements Command
{
    /**
     * @var User
     */
    private $user;

    /**
     * @var string
     */
    private $title;

    /**
     * @var Language
     */
    private $language;

    /**
     * CreateAssetCommand constructor.
     *
     * @param Language $language
     * @param User     $user
     * @param string   $title
     */
    public function __construct(Language $language, User $user, string $title)
    {
        $this->language = $language;
        $this->user     = $user;
        $this->title    = $title;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return Language
     */
    public function getLanguage(): Language
    {
        return $this->language;
    }
}