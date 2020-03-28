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
            'message' => 'required'
        ];
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return [
            'required' => 'Поле обязательно для заполнения'
        ];
    }
}
