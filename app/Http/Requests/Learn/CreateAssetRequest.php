<?php

namespace App\Http\Requests\Learn;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CreateAssetRequest
 *
 * @package App\Http\Requests
 */
class CreateAssetRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'language'  => 'required',
            'title'     => 'required',
             // 'level'     => 'required',
            'type'      => 'required'
        ];
    }
}
