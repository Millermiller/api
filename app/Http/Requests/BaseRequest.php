<?php


namespace App\Http\Requests;

use Illuminate\Http\Request;
use Scandinaver\Common\Domain\Language;

/**
 * Class BaseRequest
 *
 * @package App\Http\Requests
 */
class BaseRequest extends Request
{
    /**
     * @var Language
     */
    public $language;
}