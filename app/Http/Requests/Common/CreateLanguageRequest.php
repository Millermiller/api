<?php

namespace App\Http\Requests\Common;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CreateLanguageRequest
 *
 * @package App\Http\Requests\Common
 */
class CreateLanguageRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'title'       => 'required',
            'description' => 'required',
            'letter'      => 'required',
            'file'        => 'required',
            'image'       => 'required',
            'active'      => 'required',
        ];
    }
}
