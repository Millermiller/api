<?php

namespace App\Http\Requests\Puzzle;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class PuzzlesRequest
 *
 * @package App\Http\Requests
 */
class PuzzlesRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'lang' => 'required',
        ];
    }
}
