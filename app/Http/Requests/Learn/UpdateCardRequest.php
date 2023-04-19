<?php

namespace App\Http\Requests\Learn;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

/**
 * Class UpdateCardRequest
 *
 * @package App\Http\Requests\Learn
 */
class UpdateCardRequest extends FormRequest
{

    #[ArrayShape(['id'              => "string",
                  'examples'        => "string",
                  'translate'       => "string",
                  'translate.id'    => "string",
                  'translate.value' => "string",
                  'term'            => "string",
                  'term.id'         => "string",
                  'term.value'      => "string"
    ])]
    public function rules(): array
    {
        return [
            'id'              => 'required',
            'examples'        => 'present|array',
            'translate'       => 'required',
            'translate.id'    => 'required',
            'translate.value' => 'required',
            'term'            => 'required',
            'term.id'         => 'required',
            'term.value'      => 'required',
        ];
    }
}
