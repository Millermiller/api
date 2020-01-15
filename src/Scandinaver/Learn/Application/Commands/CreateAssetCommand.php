<?php


namespace Scandinaver\Learn\Application\Commands;

use Scandinaver\User\Domain\User;
use Scandinaver\Shared\Contracts\Command;

/**
 * Class CreateAssetCommand
 * @package Scandinaver\Learn\Application\Commands
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
     * CreateAssetCommand constructor.
     * @param User $user
     * @param string $title
     */
    public function __construct(User $user, string $title)
    {
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
}