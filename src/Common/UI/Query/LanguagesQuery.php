<?php


namespace Scandinaver\Common\UI\Query;

use Scandinaver\Common\Domain\Contract\UserInterface;
use Scandinaver\Shared\Contract\QueryInterface;

/**
 * Class LanguagesQuery
 *
 * @see     \Scandinaver\Common\Application\Handler\Query\LanguagesQueryHandler
 * @package Scandinaver\Common\UI\Query
 */
class LanguagesQuery implements QueryInterface
{

    private ?UserInterface $user;

    public function __construct(?UserInterface $user)
    {
        $this->user = $user;
    }

    public function getUser(): ?UserInterface
    {
        return $this->user;
    }
}