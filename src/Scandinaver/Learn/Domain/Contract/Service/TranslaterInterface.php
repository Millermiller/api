<?php


namespace Scandinaver\Learn\Domain\Contract\Service;


use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\Learn\Domain\Model\Word;

/**
 * Interface TranslaterInterface
 *
 * @package Scandinaver\Learn\Domain\Contract\Service
 */
interface TranslaterInterface
{

    /**
     * @param  Language  $language
     * @param  Word      $word
     *
     * @return mixed
     */
    public function translate(Language $language, Word $word);
}