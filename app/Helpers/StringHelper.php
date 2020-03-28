<?php

namespace App\Helpers;

/**
 * Class StringHelper
 *
 * @package App\Helpers
 */
class StringHelper
{
    /**
     * @param $text
     *
     * @return string
     */
    static public function cleartext($text): string
    {
        return str_replace(["\r\n", "\r", "\n"], '', strip_tags(trim($text)));
    }
}