<?php


namespace Scandinaver\Reader\UI\Query;

use Scandinaver\Common\Domain\Contract\UserInterface;
use Scandinaver\Shared\Contract\QueryInterface;

/**
 * Class ReadQuery
 *
 * @package Scandinaver\Reader\UI\Query
 *
 * @see     \Scandinaver\Reader\Application\Handler\Query\ReadQueryHandler
 */
class ReadQuery implements QueryInterface
{
    private string $text;

    private UserInterface $user;

    private string $language;

    public function __construct(UserInterface $user, string $language, string $text)
    {
        $this->text     = $text;
        $this->user     = $user;
        $this->language = $language;
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