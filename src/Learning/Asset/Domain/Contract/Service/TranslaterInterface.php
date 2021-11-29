<?php


namespace Scandinaver\Learning\Asset\Domain\Contract\Service;


use Scandinaver\Common\Domain\Entity\Language;
use Scandinaver\Learning\Asset\Domain\Entity\Term;

/**
 * Interface TranslaterInterface
 *
 * @package Scandinaver\Learn\Domain\Contract\Service
 */
interface TranslaterInterface
{

    /**
     * @param  Language  $language
     * @param  Term      $term
     *
     * @return mixed
     */
    public function translate(Language $language, Term $term);
}