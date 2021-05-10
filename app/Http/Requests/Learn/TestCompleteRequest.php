<?php

namespace App\Http\Requests\Learn;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class TestCompleteRequest
 *
 * @package App\Http\Requests
 */
class TestCompleteRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'id'      => 'required',
            'time'    => 'required',
            'percent' => 'required',
        ];
    }
}
