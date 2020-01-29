<?php
/**
 * Created by PhpStorm.
 * User: john_
 * Date: 22.11.2018
 * Time: 4:18
 */

namespace App\Helpers;


class StringHelper
{
    static public function cleartext($text)
    {
        return  str_replace(array("\r\n", "\r", "\n"), '', strip_tags(trim($text)));
    }
}