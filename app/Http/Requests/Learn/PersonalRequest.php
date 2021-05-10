<?php

namespace App\Http\Requests\Learn;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class PersonalRequest
 *
 * @package App\Http\Requests
 */
class PersonalRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'lang' => 'required',
        ];
    }
}
