<?php


namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

/**
 * Class HasLanguageRequest
 *
 * @package App\Http\Requests
 */
class HasLanguageRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'lang' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'lang.required' => 'Language not set'
        ];
    }
}