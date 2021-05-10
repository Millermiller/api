<?php

namespace App\Http\Requests\Learn;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdateAssetRequest
 *
 * @package App\Http\Requests
 */
class UpdateAssetRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'title'     => 'required',
        ];
    }
}
