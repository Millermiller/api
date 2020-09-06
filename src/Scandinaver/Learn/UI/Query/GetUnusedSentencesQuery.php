<?php


namespace Scandinaver\Learn\UI\Query;

use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\Shared\Contract\Query;

/**
 * Class GetUnusedSentencesQuery
 *
 * @see     \Scandinaver\Learn\Application\Handler\Query\GetUnusedSentencesHandler
 * @package Scandinaver\Learn\UI\Query
 */
class GetUnusedSentencesQuery implements Query
{

    private Language $language;

    public function __construct(Language $language)
    {
        $this->language = $language;
    }

    public function getLanguage(): Language
    {
        return $this->language;
    }
}