<?php

namespace App\Http\Requests\Learn;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

/**
 * Class UpdateAssetRequest
 *
 * @package App\Http\Requests
 */
class UpdateAssetRequest extends FormRequest
{

    #[ArrayShape(['title' => "string"])]
    public function rules(): array
    {
        return [
            'title'     => 'required',
        ];
    }
}
