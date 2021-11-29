<?php


namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

/**
 * Class HasLanguageRequest
 *
 * @package App\Http\Requests
 */
class HasLanguageRequest extends FormRequest
{

    #[ArrayShape(['lang' => "string"])]
    public function rules(): array
    {
        return [
            'lang' => 'required'
        ];
    }

    #[ArrayShape(['lang.required' => "string"])]
    public function messages(): array
    {
        return [
            'lang.required' => 'Language not set'
        ];
    }
}