<?php


namespace App\Http\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ProfileRequest
 *
 * @package App\Http\Requests
 */
class ProfileRequest extends FormRequest
{

    public function authorize(): bool
    {
        return TRUE;
    }

    public function rules(): array
    {
        $id = Auth::user()->getKey();

        return [
            '_login'    => "required|string|alpha_num|max:255|unique:Scandinaver\User\Domain\Model\User,login",
            '_email'    => "required|string|email|max:255|unique:Scandinaver\User\Domain\Model\User,email",
            '_password' => 'nullable|string|min:6|confirmed',
        ];
    }

    public function messages(): array
    {
        return [
            'required'  => 'Обязательное поле',
            'alpha_num' => 'Только латинские буквы и цифры',
            'confirmed' => 'Пароли не совпадают',
            'unique'    => 'Пользователь уже зарегистрирован',
            'min'       => 'Минимум :min символов',
            'email'     => 'Укажите корректный email',
        ];
    }
}
