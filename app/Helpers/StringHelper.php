<?php

namespace App\Helpers;

/**
 * Class StringHelper
 *
 * @package App\Helpers
 */
class StringHelper
{

    static public function cleartext(string $text): string
    {
        return str_replace(["\r\n", "\r", "\n"], '', strip_tags(trim($text)));
    }
}