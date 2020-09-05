<?php


namespace Scandinaver\Reader\UI\Query;

use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\Shared\Contract\Query;
use Scandinaver\User\Domain\Model\User;

/**
 * Class ReadQuery
 *
 * @package Scandinaver\Reader\UI\Query
 *
 * @see     \Scandinaver\Reader\Application\Handler\Query\ReadHandler
 */
class ReadQuery implements Query
{
    private string $text;

    private User $user;

    private Language $language;

    public function __construct(User $user, Language $language, string $text)
    {
        $this->text = $text;
        $this->user = $user;
        $this->language = $language;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getLanguage(): Language
    {
        return $this->language;
    }
}