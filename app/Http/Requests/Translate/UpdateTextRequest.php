<?php

namespace App\Http\Requests\Translate;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdateTextRequest
 *
 * @package App\Http\Requests\Translate
 */
class UpdateTextRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'title'       => 'required',
            'extra'       => 'present|array',
            'sentences'   => 'present|array',
            'published'   => 'required',
            'description' => 'present'
        ];
    }
}
