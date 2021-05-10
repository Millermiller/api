<?php


namespace App\Http\Requests\Learn;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class SearchRequest
 *
 * @package App\Http\Requests
 */
class SearchRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            // 'query'    => 'required|max:255',
            'lang'     => 'required',
            'sentence' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'min' => 'Минимум :min символа',
        ];
    }
}
