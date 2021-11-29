<?php


namespace Scandinaver\Common\UI\Query;

use Scandinaver\Common\Application\Handler\Query\LanguagesQueryHandler;
use Scandinaver\Core\Domain\Attribute\Query;
use Scandinaver\Core\Domain\Contract\UserInterface;
use Scandinaver\Core\Domain\Contract\QueryInterface;

/**
 * Class LanguagesQuery
 *
 * @package Scandinaver\Common\UI\Query
 */
#[Query(LanguagesQueryHandler::class)]
class LanguagesQuery implements QueryInterface
{

    public function __construct(private ?UserInterface $user)
    {
    }

    public function getUser(): ?UserInterface
    {
        return $this->user;
    }
}