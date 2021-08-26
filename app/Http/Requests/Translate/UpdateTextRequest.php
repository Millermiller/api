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
            'tooltips'    => 'present|array',
            'published'   => 'required',
            'description' => 'present',
            'dictionary'  => 'present|array',
            'dictionary.*.value'  => 'required',
            'dictionary.*.text'  => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'dictionary.*.value.required' => 'Введите значение перевода',
            'dictionary.*.text.required'  => 'Введите ключ перевода',
        ];
    }
}
