<?php


namespace Scandinaver\Translate\UI\Query;

use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\Shared\Contract\Query;

/**
 * Class GetTextsQuery
 *
 * @package Scandinaver\Translate\UI\Query
 *
 * @see \Scandinaver\Translate\Application\Handler\Query\GetTextsHandler
 */
class GetTextsQuery implements Query
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