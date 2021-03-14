<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CreateAssetRequest
 *
 * @package App\Http\Requests
 */
class CreateAssetRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'language'  => 'required',
            'title'     => 'required',
            'level'     => 'required',
            'type'      => 'required'
        ];
    }
}
