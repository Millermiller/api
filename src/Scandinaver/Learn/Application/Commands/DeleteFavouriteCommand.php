<?php


namespace Scandinaver\Learn\Application\Commands;

use App\Entities\User;
use Scandinaver\Shared\Command;

/**
 * Class DeleteFavouriteCommand
 * @package Scandinaver\Learn\Application\Commands
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
     * CreateFavouriteCommand constructor.
     * @param User $user
     * @param int $id
     */
    public function __construct(User $user, int $id)
    {
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
}