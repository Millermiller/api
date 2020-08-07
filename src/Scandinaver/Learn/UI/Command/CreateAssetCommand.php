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
     * @param  Language  $language
     * @param  User      $user
     * @param  string    $title
     */
    public function __construct(Language $language, User $user, string $title)
    {
        $this->language = $language;
        $this->user = $user;
        $this->title = $title;
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