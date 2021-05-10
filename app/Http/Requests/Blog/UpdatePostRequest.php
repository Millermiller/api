<?php

namespace App\Http\Requests\Blog;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdatePostRequest
 *
 * @package App\Http\Requests\Blog
 */
class UpdatePostRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'login'    => "required",
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'Выберите изображение',
            'mimes'    => 'Допустимые форматы: jpeg,jpg,png',
            'max'      => 'Максимальный размер 2Mb',
        ];
    }
}
