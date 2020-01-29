<?php

namespace App\Http\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class UploadAvatarRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'photo' => 'mimes:jpeg,jpg,png|required|max:2000'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Выберите изображение',
            'mimes' => 'Допустимые форматы: jpeg,jpg,png',
            'max' => 'Максимальный размер 2Mb',
        ];
    }
}
