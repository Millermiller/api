<?php

namespace App\Http\Requests\Puzzle;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UserPuzzlesRequest
 *
 * @package App\Http\Requests
 */
class UserPuzzlesRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'lang' => 'required',
        ];
    }
}
