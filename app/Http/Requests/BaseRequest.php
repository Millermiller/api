<?php


namespace App\Http\Requests;

use Illuminate\Http\Request;
use Scandinaver\Common\Domain\Language;

class BaseRequest extends Request
{
    /**
     * @var Language
     */
    public $language;
}