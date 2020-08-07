<?php


namespace Scandinaver\Learn\UI\Query;

use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\Shared\Contract\Query;

/**
 * Class WordsCountByLanguageQuery
 *
 * @see     \Scandinaver\Learn\Application\Handler\Query\WordsCountByLanguageHandler
 * @package Scandinaver\Learn\UI\Query
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
     * @param  Language  $language
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