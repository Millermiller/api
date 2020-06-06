<?php


namespace Scandinaver\Learn\Application\Query;

use Scandinaver\Common\Domain\Language;
use Scandinaver\Shared\Contracts\Query;

/**
 * Class WordsCountByLanguageQuery
 *
 * @package Scandinaver\Learn\Application\Query
 * @see \Scandinaver\Learn\Application\Handlers\WordsCountByLanguageHandler
 */
class WordsCountByLanguageQuery implements Query
{
    /**
     * @var Language
     */
    private $language;

    /**
     * WordsCountByLanguageQuery constructor.
     *
     * @param Language $language
     */
    public function __construct(Language $language)
    {
        $this->language = $language;
    }

    /**
     * @return Language
     */
    public function getLanguage(): Language
    {
        return $this->language;
    }
}