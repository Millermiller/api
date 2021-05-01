<?php


namespace Scandinaver\Puzzle\UI\Query;

use Scandinaver\Common\Domain\Contract\UserInterface;
use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class UserPuzzlesQuery
 *
 * @see     \Scandinaver\Puzzle\Application\Handler\Query\UserPuzzlesQueryHandler
 * @package Scandinaver\Puzzle\UI\Query
 */
class UserPuzzlesQuery implements CommandInterface
{
    private UserInterface $user;

    private string $language;

    public function __construct(string $language, UserInterface $user)
    {
        $this->user     = $user;
        $this->language = $language;
    }

    public function getUser(): UserInterface
    {
        return $this->user;
    }

    public function getLanguage(): string
    {
        return $this->language;
    }
}