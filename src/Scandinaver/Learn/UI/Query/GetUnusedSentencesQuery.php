<?php


namespace Scandinaver\Learn\UI\Query;

use Scandinaver\Shared\Contract\Query;

/**
 * Class GetUnusedSentencesQuery
 *
 * @see     \Scandinaver\Learn\Application\Handler\Query\GetUnusedSentencesHandler
 * @package Scandinaver\Learn\UI\Query
 */
class GetUnusedSentencesQuery implements Query
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