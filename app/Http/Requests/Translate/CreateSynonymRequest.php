<?php


namespace App\Http\Requests\Translate;


use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CreateSynonymRequest
 *
 * @package App\Http\Requests\Translate
 */
class CreateSynonymRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'value' => 'required',
            'wordId' => 'required'
        ];
    }
}