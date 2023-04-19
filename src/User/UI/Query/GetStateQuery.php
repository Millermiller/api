<?php


namespace Scandinaver\User\UI\Query;

use Scandinaver\Core\Domain\Attribute\Handler;
use Scandinaver\Core\Domain\Contract\QueryInterface;
use Scandinaver\Core\Domain\Contract\UserInterface;
use Scandinaver\User\Application\Handler\Query\GetStateQueryHandler;

/**
 * Class GetStateQuery
 *
 * @package Scandinaver\User\UI\Query
 */
#[Handler(GetStateQueryHandler::class)]
class GetStateQuery implements QueryInterface
{

    public function __construct(private UserInterface $user, private string $language)
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