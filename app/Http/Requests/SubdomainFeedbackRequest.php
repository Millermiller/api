<?php


namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class SubdomainFeedbackRequest
 *
 * @package App\Http\Requests
 */
class SubdomainFeedbackRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'message' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'Поле обязательно для заполнения'
        ];
    }
}
