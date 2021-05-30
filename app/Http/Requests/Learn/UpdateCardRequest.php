<?php

namespace App\Http\Requests\Learn;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdateCardRequest
 *
 * @package App\Http\Requests\Learn
 */
class UpdateCardRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'id'              => 'required',
            'examples'        => 'present|array',
            'translate'       => 'required',
            'translate.id'    => 'required',
            'translate.value' => 'required',
            'word'            => 'required',
            'word.id'         => 'required',
            'word.value'      => 'required',
        ];
    }
}
