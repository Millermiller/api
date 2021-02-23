<?php


namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UploadAvatarRequest
 *
 * @package App\Http\Requests
 */
class UploadAvatarRequest extends FormRequest
{
    public function authorize(): bool
    {
        return TRUE;
    }

    public function rules(): array
    {
        return [
            'photo' => 'mimes:jpeg,jpg,png|required|max:2000',
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
