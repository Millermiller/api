<?php


namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

/**
 * Class FilteringRequest
 *
 * @package App\Http\Requests
 */
class FilteringRequest extends FormRequest
{
    use ApiRequestParsingTrait;

    public function rules(): array
    {
        return [

        ];
    }
}