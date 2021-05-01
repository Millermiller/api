<?php


namespace Scandinaver\Translate\UI\Query;

use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class GetTextsQuery
 *
 * @package Scandinaver\Translate\UI\Query
 *
 * @see     \Scandinaver\Translate\Application\Handler\Query\GetTextsQueryHandler
 */
class GetTextsQuery implements CommandInterface
{
    private string $language;

    public function __construct(string $language)
    {
        $this->language = $language;
    }

    public function getLanguage(): string
    {
        return $this->language;
    }
}