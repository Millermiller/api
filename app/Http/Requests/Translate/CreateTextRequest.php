<?php

namespace App\Http\Requests\Translate;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CreateTextRequest
 *
 * @package App\Http\Requests\Translate
 */
class CreateTextRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'title'     => 'required',
            'language'  => 'required',
            'original'  => 'required',
            'translate' => 'required'
        ];
    }
}
