<?php


namespace Scandinaver\Learn\UI\Command;

use Scandinaver\Shared\Contract\Command;
use Scandinaver\User\Domain\Model\User;

/**
 * Class CreateAssetCommand
 *
 * @package Scandinaver\Learn\UI\Command
 *
 * @see     \Scandinaver\Learn\Application\Handler\Command\CreateAssetHandler
 */
class CreateAssetCommand implements Command
{
    private User $user;

    private array $data;

    public function __construct(User $user, array $data)
    {
        $this->user = $user;
        $this->data = $data;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getData(): array
    {
        return $this->data;
    }
}