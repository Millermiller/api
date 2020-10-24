<?php


namespace Scandinaver\Learn\Domain\Contract\Service;


use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\Learn\Domain\Model\Word;

interface TranslaterInterface
{
    public function translate(Language $language, Word $word);
}