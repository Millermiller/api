<?php


namespace Scandinaver\Learn\Infrastructure;

use Scandinaver\Learn\Domain\Contracts\AudioParserInterface;
use Scandinaver\Learn\Domain\Exceptions\AudioFileCantParsedException;
use Sunra\PhpSimple\HtmlDomParser;

/**
 * Class ForvoParser
 *
 * @package Scandinaver\Learn\Infrastructure
 */
class ForvoParser implements AudioParserInterface
{
    /** TODO: добавить авторизацию и использование cookies (где-то на bitbucket)
     *
     * @param string $word
     *
     * @return string
     * @throws AudioFileCantParsedException
     */
    public function parse(string $word): string
    {
        $html = @file_get_contents('http://forvo.com/word/' . $word . '/#' . env('SHORTLANG'));

        $dom = HtmlDomParser::str_get_html($html);

        $onclick = $dom->find('em[id=is]')[0]->parent()->next_sibling()->find('li')[0]->first_child()->onclick;

        if (!$onclick) throw new AudioFileCantParsedException();

        $arr = explode("'", $onclick);

        $link = (isset($arr[1])) ? $arr[1] : null;

        if (!$link) throw new AudioFileCantParsedException();

        return $link;
    }
}