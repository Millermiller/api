<?php


namespace Scandinaver\Learn\UI\Query;

use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\Shared\Contract\Query;

/**
 * Class AudioCountByLanguageQuery
 *
 * @see     \Scandinaver\Learn\Application\Handler\Query\AudioCountByLanguageHandler
 * @package Scandinaver\Learn\UI\Query
 */
class AudioCountByLanguageQuery implements Query
{
    /**
     * @var Language
     */
    private $language;

    /**
     * AudioCountByLanguageQuery constructor.
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