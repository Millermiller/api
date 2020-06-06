<?php


namespace Scandinaver\Learn\Application\Query;

use Scandinaver\Common\Domain\Language;
use Scandinaver\Shared\Contracts\Query;

/**
 * Class TextsCountByLanguageQuery
 *
 * @package Scandinaver\Learn\Application\Query
 * @see \Scandinaver\Learn\Application\Handlers\TextsCountByLanguageHandler
 */
class TextsCountByLanguageQuery implements Query
{
    /**
     * @var Language
     */
    private $language;

    /**
     * TextsCountByLanguageQuery constructor.
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