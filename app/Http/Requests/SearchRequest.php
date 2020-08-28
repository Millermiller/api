<?php


namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class SearchRequest
 *
 * @package App\Http\Requests
 */
class SearchRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'word' => 'required|min:3|max:255'
        ];
    }

    public function messages(): array
    {
        return [
            'min' => 'Минимум :min символа'
        ];
    }
}
