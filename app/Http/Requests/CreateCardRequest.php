<?php


namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CreateCardRequest
 *
 * @package App\Http\Requests
 */
class CreateCardRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'word'      => 'required',
            'translate' => 'required',
        ];
    }
}
