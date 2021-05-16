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
            'category'       => "required",
            'status'         => "required",
            'title'          => "required|max:255",
            'content'        => "required",
            'comment_status' => "required",
            'anonse'         => "required",
        ];
    }

    public function messages(): array
    {
        return [
            'title.required'   => 'Введите название',
            'content.required' => 'Введите содержимое',
            'anonse.required'  => 'Введите анонс',
        ];
    }
}
