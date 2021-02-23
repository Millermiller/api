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
        return TRUE;
    }

    public function rules(): array
    {
        return [
            'query' => 'required|min:3|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'min' => 'Минимум :min символа',
        ];
    }
}
