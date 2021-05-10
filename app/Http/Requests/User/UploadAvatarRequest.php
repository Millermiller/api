<?php


namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UploadAvatarRequest
 *
 * @package App\Http\Requests
 */
class UploadAvatarRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'file' => 'mimes:jpeg,jpg,png|required|max:2000',
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
