<?php


namespace Scandinaver\Learning\Puzzle\UI\Query;

use Scandinaver\Core\Domain\Attribute\Handler;
use Scandinaver\Core\Domain\Contract\QueryInterface;
use Scandinaver\Core\Domain\Contract\UserInterface;
use Scandinaver\Learning\Puzzle\Application\Handler\Query\UserPuzzlesQueryHandler;

/**
 * Class UserPuzzlesQuery
 *
 * @package Scandinaver\Puzzle\UI\Query
 */
#[Handler(UserPuzzlesQueryHandler::class)]
class UserPuzzlesQuery implements QueryInterface
{

    public function __construct(private string $language, private UserInterface $user)
    {
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