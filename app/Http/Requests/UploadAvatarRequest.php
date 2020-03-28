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
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'photo' => 'mimes:jpeg,jpg,png|required|max:2000'
        ];
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return [
            'required' => 'Выберите изображение',
            'mimes'    => 'Допустимые форматы: jpeg,jpg,png',
            'max'      => 'Максимальный размер 2Mb',
        ];
    }
}
