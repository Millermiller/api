<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class PersonalRequest
 *
 * @package App\Http\Requests
 */
class PersonalRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'lang' => 'required',
        ];
    }
}
