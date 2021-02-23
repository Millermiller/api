<?php


namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class FeedbackRequest
 *
 * @package App\Http\Requests
 */
class FeedbackRequest extends FormRequest
{
    public function authorize(): bool
    {
        return TRUE;
    }

    public function rules(): array
    {
        return [
            'name'    => 'required|max:255',
            'message' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'Поле обязательно для заполнения',
        ];
    }
}
