<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class SignupRequest
 *
 * @package App\Http\Requests
 */
class SignupRequest extends FormRequest
{
    public function authorize(): bool
    {
        return TRUE;
    }

    public function rules(): array
    {
        return [
            'login'    => "required|string|alpha_num|max:255|unique:Scandinaver\User\Domain\Model\User,login",
            'email'    => "required|string|email|max:255|unique:Scandinaver\User\Domain\Model\User,email",
            'password' => 'nullable|string|min:6|confirmed',
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
