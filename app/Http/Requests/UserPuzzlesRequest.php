<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UserPuzzlesRequest
 *
 * @package App\Http\Requests
 */
class UserPuzzlesRequest extends FormRequest
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
