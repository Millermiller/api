<?php


namespace App\Http\Requests\Learn;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CreateWordRequest
 *
 * @package App\Http\Requests\Learn
 */
class CreateWordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return TRUE;
    }

    public function rules(): array
    {
        return [
            'orig'      => 'required',
            'translate' => 'required',
            'is_public' => 'required',
        ];
    }
}
