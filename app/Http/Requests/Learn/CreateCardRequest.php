<?php


namespace App\Http\Requests\Learn;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CreateCardRequest
 *
 * @package App\Http\Requests
 */
class CreateCardRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'word'      => 'required',
            'translate' => 'required',
            'language'  => 'required',
        ];
    }
}
