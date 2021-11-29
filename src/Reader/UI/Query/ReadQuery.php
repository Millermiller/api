<?php


namespace Scandinaver\Reader\UI\Query;

use Scandinaver\Core\Domain\Attribute\Query;
use Scandinaver\Core\Domain\Contract\UserInterface;
use Scandinaver\Core\Domain\Contract\QueryInterface;
use Scandinaver\Reader\Application\Handler\Query\ReadQueryHandler;

/**
 * Class ReadQuery
 *
 * @package Scandinaver\Reader\UI\Query
 */
#[Query(ReadQueryHandler::class)]
class ReadQuery implements QueryInterface
{

    public function __construct(private UserInterface $user, private string $language, private string $text)
    {
    }

    public function getText(): string
    {
        return $this->text;
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