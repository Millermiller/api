<?php


namespace Scandinaver\User\UI\Query;

use Scandinaver\Common\Domain\Contract\UserInterface;
use Scandinaver\Shared\Contract\QueryInterface;

/**
 * Class GetStateQuery
 *
 * @see     \Scandinaver\User\Application\Handler\Query\GetStateQueryHandler
 * @package Scandinaver\User\UI\Query
 */
class GetStateQuery implements QueryInterface
{

    private UserInterface $user;

    private string $language;

    public function __construct(UserInterface $user, string $language)
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